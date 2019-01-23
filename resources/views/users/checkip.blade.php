@extends('layouts.default')
@section('title','IP检测')

@section('content')
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <div class="col-md-12">
                <div class="offset-md-2 col-md-8">
                    <table>
                        <tr>
                            <td>您的IP：{{ $data['ip'] }}</td>
                        </tr>
                        @if($data['country'] !== 'XX')
                        <tr>
                            <td>国家: {{ $data['country'] }}</td>
                        </tr>
                        @endif
                        @if($data['region'] !== 'XX')
                        <tr>
                            <td>地区： {{ $data['region'] }} @if($data['city'] !== 'XX') {{ $data['city'] }} @endif @if($data['county'] !== 'XX'){{ $data['county'] }} @endif</td>
                        </tr>
                        @endif
                        @if($data['isp'] !== 'XX')
                        <tr>
                            <td>运营商： {{ $data['isp'] }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
