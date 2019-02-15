@extends('layouts.front')

@section('content')

<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <span class="login100-form-title p-b-59">
        Proses pendaftaran
    </span>

    <div class="alert alert-info">
        Verifikasi email berhasil, lanjutkan dengan mengisi form dibawah ini
    </div>
    <br/>
    <input id="name" type="hidden" class="form-control" name="name" value="{{ $data['name'] }}">
    <input id="name" type="hidden" class="form-control" name="email" value="{{ $data['email'] }}">

    <div class="wrap-input100 validate-input" data-validate = "Password is required">
        <span class="label-input100">Password</span>
        <input class="input100" type="password" name="password" placeholder="*************">
        <span class="focus-input100"></span>
    </div>

    <div class="wrap-input100 validate-input" data-validate = "Repeat Password is required">
        <span class="label-input100">Repeat Password</span>
        <input class="input100" type="password" name="password_confirmation" placeholder="*************">
        <span class="focus-input100"></span>
    </div>

    <div class="container-login100-form-btn">
        <div class="wrap-login100-form-btn">
            <div class="login100-form-bgbtn"></div>
            <button class="login100-form-btn" type="submit">
                Lanjutkan
            </button>
        </div>

        <a href="#" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
            Login
            <i class="fa fa-long-arrow-right m-l-5"></i>
        </a>
    </div>
</form>

@endsection