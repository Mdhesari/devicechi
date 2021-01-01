@extends('admin::app')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">شارژ حساب کاربر</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route("admin.payments.add") }}" method="POST" role="form">
                        @csrf

                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">عنوان</label>
                                <input value="{{ old('title') }}" type="text" class="form-control" id="title" name="title"
                                    placeholder="شارژ حساب آقای بهرامی...">
                            </div>
                            @error('title')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label for="description">توضیحات</label>
                                <input value="{{ old('description') }}" type="description" class="form-control" id="description" name="description"
                                    placeholder="پول را به صورت نقدی پرداخت کرده است...">
                            </div>
                            @error('description')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label for="amount">مقدار</label>
                                <input value="{{ old('amount') }}" type="number" class="form-control" id="amount" name="amount"
                                    placeholder="مثال :‌۲۳۰۰۰">
                                <small id="amount_help" class="form-text text-muted"></small>
                            </div>
                            @error('amount')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label for="verified_code">کد پیگیری</label>
                                <input value="{{ old('verified_code') }}" type="verified_code" class="form-control" id="verified_code" name="amount"
                                    placeholder="کد پیگیری پرداخت...">
                                <small id="verified_code_help" class="form-text text-muted">اختیاری</small>
                            </div>
                            @error('verified_code')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <!-- select -->
                            <div class="form-group">
                                <label>انتخاب کاربر</label>
                                <select name="user_id" class="form-control">
                                    <option value="null" selected>-- انتخاب کاربر --</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        <span>{{ $user->name }}</span>
                                        |
                                        <span>{{ $user->mobile }}</span>
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('user_id')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-check">
                                <input value="{{ old('') }}" type="checkbox" class="form-check-input" name="admin_verified"
                                    id="admin_verified">
                                <label class="form-check-label" for="admin_verified">
                                    تایید شده توسط ادمین {{ $admin->email }}
                                </label>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">@lang(' Save ')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@push('add_scripts')
<script>
    jQuery(function($) {
            $('#amount').on('keyup',function(e) {
                $('#amount_help').html(calcPrice($(this).val()))
            })
        })
</script>
@endpush