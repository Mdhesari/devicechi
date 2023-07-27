@extends('admin::app')

@section('content')
<h1>hello {{ $admin->name }}</h1>
@endsection

@push('add_scripts')


@endpush