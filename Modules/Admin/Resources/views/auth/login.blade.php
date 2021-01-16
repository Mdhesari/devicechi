@extends('admin::guest')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html">
            Admin Panel
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">ورود به پنل کاربری</p>

            <form action="{{ route('admin.login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input name="email" type="email" class="form-control" value="{{ old('email') }}"
                        placeholder="Email">
                    <div class="input-group-append">
                        <span class="fa fa-envelope input-group-text"></span>
                    </div>

                </div>

                @error('email')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                <div class="input-group mb-3">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <span class="fa fa-lock input-group-text"></span>
                    </div>

                </div>

                @error('password')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input name="remember_me" type="checkbox" id="remember">
                            <label for="remember">
                                مرا به خاطر بسپار
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">ورود</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->

            {{-- <p class="mb-1">
                <a href="#">رمز عبور را فراموش کرده اید؟!!</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('admin.register') }}" class="text-center">هنوز ثبت نام نکرده اید؟!</a>
            </p> --}}
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection