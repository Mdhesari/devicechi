@extends('admin::app')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang(' Charge User Account ')</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route("admin.payments.add") }}" method="POST" role="form">
                        @csrf

                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">@lang(' Title ')</label>
                                <input value="{{ old('title') }}" type="text" class="form-control" id="title"
                                    name="title" placeholder="{{__(' Title ')}}">
                            </div>
                            @error('title')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label for="description">@lang(' Description ')</label>
                                <input value="{{ old('description') }}" type="description" class="form-control"
                                    id="description" name="description" placeholder="{{__(' Description ')}}">
                            </div>
                            @error('description')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label for="amount">@lang(' Amount ')</label>
                                <input value="{{ old('amount') }}" type="number" class="form-control" id="amount"
                                    name="amount" placeholder="{{__(' Amount ')}}">
                                <small id="amount_help" class="form-text text-muted"></small>
                            </div>
                            @error('amount')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <!-- select -->
                            <div class="form-group">
                                <label for="users-search">@lang(' Choose User ')</label>

                                <x-auto-complete-search :options="$users" :single="true" id="users-search"
                                    name="user_id" :route="route('admin.users.search')"
                                    placeholder="{{__(' Choose User ')}}" :defaults="old('user_id')">
                                </x-auto-complete-search>

                            </div>
                            @error('user_id')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="admin_verified"
                                    id="admin_verified">
                                <label class="form-check-label" for="admin_verified">
                                    <a class="btn btn-link" href="{{ route("admin.admins.show", $admin) }}">
                                        @lang(' Verified By Admin ',
                                        ['email' => $admin->email])
                                    </a>
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