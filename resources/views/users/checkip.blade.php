@extends('layouts.default')
@section('title','IP检测')

@section('content')
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <div class="col-md-12">
                <div class="offset-md-2 col-md-8">
                    <table>
                        <tr>
                            <td>
                                <form name="form" action="checkip" method="get" style="text-align: center;">
                                    {{ csrf_field() }}
                                    输入 IP：<input type="text" name="ip" onkeyup="value=value.replace(/[^\d.]/g,'')">
                                    <button type="submit" style="color: #040505">查询</button>
                                </form>
                            </td>
                        </tr>
                        @if(isset($data['status']) && $data['status'] == 'success')
                        @if(isset($data['ip']))
                        <tr>
                            <td>IP：{{ $data['ip'] }}</td>
                        </tr>
                        @endif
                        @if(isset($data['country']))
                        <tr>
                            <td>国家: {{ $data['country'] }}</td>
                        </tr>
                        <tr>
                            <td>省市: {{ $data['region'] }}</td>
                        </tr>
                        <tr>
                            <td>城市: {{ $data['city'] }}</td>
                        </tr>
                        @endif
                        @if(isset($data['lat']))
                        <tr>
                            <td>经度：{{ $data['lon'] }}</td>
                        </tr>
                        <tr>
                            <td>纬度：{{ $data['lat'] }}</td>
                        </tr>
                        @endif
                        @if(isset($data['isp']))
                        <tr>
                            <td>运营商：{{ $data['isp'] }}</td>
                        </tr>
                        @endif
                        @else
                            <p>查询的 IP 为内网 IP ！</p>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
