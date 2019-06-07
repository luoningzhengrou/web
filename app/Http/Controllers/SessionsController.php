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
        $ip = $request->ip;
        if ($ip){
            $ip = ip2long($ip);
            $ip = long2ip($ip);
            if ($ip == '0.0.0.0'){
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $url = 'http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip;
        $c_data = json_decode(@file_get_contents($url),true);
        $data = $c_data['data'];
        if ($c_data['code'] == 0){
            $data['status'] = 'success';
        }
        if (isset($data['country']) && $data['country'] != '中国'){
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

}
