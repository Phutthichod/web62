@extends('template.layout')

@section('title','pinto')

@section('content')
<link rel="stylesheet" href="{{asset('css/login/style.css')}}">
<div class="container">
    <div class="login-form">
        <div class="logo">
            <img src="{{ asset('img/KU_SubLogo.png') }}" alt=""><strong>SAKUNA ห้องพัก</strong>
        </div>
        <form  method="post" action="/login">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="password">
            </div>
            <button class="btn btn-success" type="submit">Login</button>

        </form>
    </div>

</div>


@endsection
