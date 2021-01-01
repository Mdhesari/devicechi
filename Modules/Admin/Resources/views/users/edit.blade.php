@extends('admin::app')

@section('content')
<div class="register-box">
    <div class="register-logo">
        {{--  --}}
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">@lang(' Edit User ')</p>

            <form action="{{ route("admin.users.edit", ['user' => $user]) }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input value="{{ $user->name }}" name="name" type="text" class="form-control"
                        placeholder="نام و نام خانوادگی">
                    <div class="input-group-append">
                        <span class="fa fa-user input-group-text"></span>
                    </div>
                </div>
                @error('name')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <input value="{{ $user->mobile }}" name="mobile" type="tel" class="form-control"
                        placeholder="موبایل">
                    <div class="input-group-append">
                        <span class="fa fa-envelope input-group-text"></span>
                    </div>
                </div>
                @error('mobile')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <input name="password" type="password" class="form-control password-input" placeholder="رمز عبور">
                    <div class="input-group-append">
                        <span class="fa fa-lock input-group-text"></span>
                    </div>
                </div>
                @error('password')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    <input name="password_confirmation" type="password" class="form-control password-input"
                        placeholder="تکرار رمز عبور">
                    <div class="input-group-append">
                        <span class="fa fa-lock input-group-text"></span>
                    </div>
                </div>
                @error('password_confirmation')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                <div class="row">
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
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang(' Submit ')</button>
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
    $(document).ready( function () {

    $('#email_password_checkbox').on("change", function(ev) {

        $(".password-input").prop("disabled",this.checked)
        $(".password-input").val("")
    });
} );
</script>

@endpush