@extends('layouts.default')
@section('title','IP检测')

@section('content')
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <div class="col-md-12">
                <div class="offset-md-2 col-md-8">
                    @if($data['status'] == 'success')
                    <table>
                        <tr>
                            <td>您的IP：{{ $data['query'] }}</td>
                        </tr>
                        @if($data['country'])
                        <tr>
                            <td>国家: {{ $data['country'] }}</td>
                        </tr>
                        <tr>
                            <td>城市: {{ $data['city'] }}</td>
                        </tr>
                        @endif
                        @if($data['region'])
                        <tr>
                            <td>经度：{{ $data['lon'] }}</td>
                        </tr>
                        <tr>
                            <td>纬度：{{ $data['lat'] }}</td>
                        </tr>
                        @endif
                        @if($data['isp'])
                        <tr>
                            <td>运营商： {{ $data['isp'] }}</td>
                        </tr>
                        @endif
                    </table>
                    @else
                        <p>恭喜你来到新的世界！</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
