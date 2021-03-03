@extends('admin::app')

@section('content')
<div class="container">
    <div class="card mb-6">
        <div class="card-body register-card-body">
            <p class="login-box-msg">@lang(' Add new menu ')</p>

            <form action="{{ route("admin.menu-editor.store.group") }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input value="{{ old('name') }}" name="name" type="text" class="form-control" placeholder="{{__(' Name ')}}">
                    <div class="input-group-append">
                        <span class="fas fa-heading input-group-text"></span>
                    </div>
                </div>
                @error('name')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                <div class="input-group mb-3">
                    <input value="{{ old('key') }}" name="key" type="text" class="form-control" placeholder="{{__(' Key ')}}">
                    <div class="input-group-append">
                        <span class="fas fa-heading input-group-text"></span>
                    </div>
                </div>
                @error('key')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror

                <!-- /.col -->
                <div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat mb-2">@lang(' Create ')</button>
                </div>
                <!-- /.col -->
            </form>
        </div>
    </div>
</div>
</div>
@endsection
