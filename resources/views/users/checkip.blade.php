@extends('layouts.default')
@section('title','IP检测')

@section('content')
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <div class="col-md-12">
                <div class="offset-md-2 col-md-8">
                    @foreach($data as $k => $v)
                        <li class="nav-item"><span>{{ strtoupper($k) }}</span>: {{ $v }}</li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
