@extends('admin::app')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang(' Export Settings ')</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route("admin.settings.export.index") }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <div class="form-group">
                                <label for="font">@lang(' Font ')</label>
                                @if(!empty($font_name))
                                <p>
                                    <span>@lang(' Current : ')</span>
                                    <span>{{ $font_name }}</span>
                                </p>
                                @endif
                                <input accept=".ttf" required type="file" name="font" class="form-control">
                            </div>
                            @error('font')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

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
    //
</script>
@endpush
