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
            <p class="login-box-msg">ثبت نام کاربر</p>

            <form action="{{ route('admin.login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input name="email" type="email" class="form-control" value="@old('email')" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="alert alert-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">ورود</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->

            <p class="mb-0">
                <a href="{{ route('admin.login') }}" class="text-center">قبلا ثبت نام کرده اید؟</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection