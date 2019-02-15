@extends('layouts.front')

@section('content')

<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <span class="login100-form-title p-b-59">
        Login
    </span>
    
    @if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
    <br/>
    @endif

    <div class="wrap-input100 validate-input" data-validate = "Masukkan email yang sesuai, contoh: ex@abc.xyz">
        <span class="label-input100">Email</span>
        <input class="input100" type="text" name="email" value="{{ old('email') }}" placeholder="Email...">
        <span class="focus-input100"></span>
    </div>

    <div class="wrap-input100 validate-input" data-validate = "Password is required">
        <span class="label-input100">Password</span>
        <input class="input100" type="password" name="password" placeholder="*************">
        <span class="focus-input100"></span>
    </div>

    <div class="container-login100-form-btn">
        <div class="wrap-login100-form-btn">
            <div class="login100-form-bgbtn"></div>
            <button class="login100-form-btn" type="submit">
                Login
            </button>
        </div>

        <a href="{{route('front.new.get')}}" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
            Daftar
            <i class="fa fa-long-arrow-right m-l-5"></i>
        </a>
    </div>
</form>

@endsection