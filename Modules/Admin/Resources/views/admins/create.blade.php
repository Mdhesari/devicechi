@extends('admin::app')

@section('content')
<div class="register-box">
    <div class="register-logo">
        {{--  --}}
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">@lang('Create Admin User')</p>

            <form action="{{ route("admin.admins.add") }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input value="{{ old('name') }}" name="name" type="text" class="form-control"
                        placeholder="نام و نام خانوادگی">
                    <div class="input-group-append">
                        <span class="fa fa-user input-group-text"></span>
                    </div>
                </div>
                @error('name')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <input value="{{ old('email') }}" name="email" type="tel" class="form-control" placeholder="ایمیل">
                    <div class="input-group-append">
                        <span class="fa fa-envelope input-group-text"></span>
                    </div>
                </div>
                @error('email')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <input autocomplete="off" type="password" name="password" class="form-control password-input"
                        placeholder="رمز عبور">
                    <div class="input-group-append">
                        <span class="fa fa-lock input-group-text"></span>
                    </div>
                </div>
                @error('password')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <input autocomplete="off" type="password" name="password_confirmation"
                        class="form-control password-input" placeholder="تکرار رمز عبور">
                    <div class="input-group-append">
                        <span class="fa fa-lock input-group-text"></span>
                    </div>
                </div>
                @error('password_confirmation')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">

                    <select class="form-control" name="role" id="select-role">
                        <option selected :value="null">@lang(' Choose Role ')</option>
                        @foreach ($roles as $role)
                        <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                @error('role')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                <div class="col-8">
                    <div class="checkbox icheck">
                        <label>
                            <input name="email_password" id="email_password_checkbox" type="checkbox">
                            @lang(' Send Random Password To User ')
                        </label>
                    </div>
                </div>
                @error('email_password')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">ثبت</button>
                </div>
                <!-- /.col -->
        </div>
        </form>
    </div>
    <!-- /.form-box -->
</div><!-- /.card -->
</div>
@endsection

@push('add_scripts')

<script>
    $(document).ready(function () {

            $('#email_password_checkbox').on("change", function (ev) {

                $(".password-input").prop("disabled", this.checked)
                $(".password-input").val("")
            });
        });
</script>

@endpush