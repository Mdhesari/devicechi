@extends('admin::app')

@push('add_styles')
<style>
    .ck-editor__editable {
        min-height: 500px;
    }
</style>
@endpush

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        @lang(' Create Page ')
                    </h3>
                    <!-- tools box -->
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- form start -->
                    <form action="{{ route("admin.pages.create") }}" method="POST" role="form">
                        @csrf

                        <div class="form-group">
                            <label for="title">@lang(' Title ')</label>
                            <input value="{{ old('title') }}" type="text" class="form-control form-control-lg" id="title" name="title" placeholder="{{__(' Title ')}}">
                        </div>
                        @error('title')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="slug">@lang(' Slug ')</label>
                            <input value="{{ old('slug') }}" type="text" class="form-control form-control" id="slug" name="slug" placeholder="{{__(' Slug ')}}">
                        </div>
                        @error('slug')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="editor">@lang(' Text ')</label>
                            <div class="mb-3">
                                <textarea id="editor" name="body" style="width: 100%">لطفا متن مورد نظر خودتان را وارد کنید</textarea>
                            </div>
                            <p class="text-sm mb-0">مشاهده مستندات مربوط به این ویرایشگر متن <a href="https://ckeditor.com/ckeditor-5-builds/#classic">CKEditor</a>
                            </p>
                        </div>
                        @error('body')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="meta_tag_title">@lang(' Meta Tag Title ')</label>
                            <input value="{{ old('meta_tag_title') }}" type="text" class="form-control" id="meta_tag_title" name="meta_tag_title" placeholder="{{__(' Meta Tag Title ')}}">
                        </div>
                        @error('meta_tag_title')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="meta_description">@lang(' Meta Description ')</label>
                            <input value="{{ old('meta_description') }}" type="text" class="form-control" id="meta_description" name="meta_description" placeholder="{{__(' Meta Description ')}}">
                        </div>
                        @error('meta_description')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="meta_keywords">@lang(' Meta Keywords ')</label>
                            <input value="{{ old('meta_keywords') }}" type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="{{__(' Meta Keywords ')}}">
                            <small class="help-text">@lang(' Seperate with . ')</small>
                        </div>
                        @error('meta_keywords')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <button type="submit" class="btn btn-success">@lang(' Save ')</button>
                    </form>
                </div>
            </div>

            <!-- /.card -->
        </div>
    </div>
</section>
@endsection

@push('add_scripts')
<script src="{{ asset('css/admin/plugins/ckeditor/ckeditor.js') }}"></script>

<script>
    $(function() {
        // Replace the <textarea id="editor"> with a CKEditor
        // instance, using default configuration.
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(function(editor) {
                // The editor instance
            })
            .catch(function(error) {
                console.error(error)
            })
    })
</script>
@endpush
