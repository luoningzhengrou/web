<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{

    public function __construct(){
        $this->middleware('guest',[
           'only' => ['create']
        ]);
    }

    public function create(){
        return view('sessions.create');
    }

    public function store(Request $request){
        $credentials = $this->validate($request,[
           'email' => 'required|email|max:255',
           'password' => 'required'
        ]);
        if (Auth::attempt($credentials, $request->has('remember'))){
            if (Auth::user()->activated){
                session()->flash('success', '欢迎回来！');
                $fallback = route('users.show', Auth::user());
                $redirect =  redirect()->intended($fallback);
            }else{
                Auth::logout();
                session()->flash('warning','你的账号未激活，请检查邮箱中的注册邮件进行激活。');
                return redirect('/');
            }
        }else{
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配！');
            $redirect = redirect()->back()->withInput();
        }
        return $redirect;
    }

    public function destroy(){
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }

    public function checkip(Request $request){
        if (isset($request->ip) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $request->ip)){
            $ip = $request->ip;
        }else{
            $ip = $this->getIp();
        }
        $url = 'http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip;
        $c_data = json_decode(@file_get_contents($url),true);
        $data = $c_data['data'];
        if ($c_data['code'] == 0){
            $data['status'] = 'success';
        }
        if ($data['isp'] == '内网IP'){
            $data['country'] = '内网IP';
            $data['region'] = '内网IP';
        }
        if (isset($data['country']) && $data['country'] != '中国' && $data['isp'] != '内网IP'){
            $url = "http://ip-api.com/json/$ip?lang=zh-CN";
            $r_data = json_decode(@file_get_contents($url),true);
            $data = $r_data;
            $data['ip'] = $r_data['query'];
            if ($r_data['status'] == 'success'){
                $data['country'] = $r_data['country'];
                $data['region'] = $r_data['regionName'];
                $data['city'] = $r_data['city'];
                $data['isp'] = $r_data['isp'];
            }
        }
        return view('users.checkip', compact('data'));
    }

    public function getIp()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] AS $xip) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                    $ip = $xip;
                    break;
                }
            }
        } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } elseif (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_IP'])) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        }
        return $ip;
    }

}
