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
                        <tr>
                            <td>国家: {{ $data['country'] }}</td>
                        </tr>
                        <tr>
                            <td>地区: {{ $data['region'] }} {{ $data['city'] }} {{ $data['county'] }}</td>
                        </tr>
                        <tr>
                            <td>运营商: {{ $data['isp'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
