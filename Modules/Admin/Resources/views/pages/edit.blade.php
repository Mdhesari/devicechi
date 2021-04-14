@extends('admin::app')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        @lang(' Edit Page ')
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
                    <form action="{{ route('admin.pages.edit', $page) }}" method="POST" role="form">
                        @csrf

                        <div class="form-group">
                            <label for="title">@lang(' Title ')</label>
                            <input value="{{ $page->title }}" type="text" class="form-control form-control-lg" id="title" name="title" placeholder="{{__(' Title ')}}">
                        </div>
                        @error('title')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="slug">@lang(' Slug ')</label>
                            <input value="{{ $page->slug }}" type="text" class="form-control form-control" id="slug" name="slug" placeholder="{{__(' Slug ')}}">
                        </div>
                        @error('slug')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="editor">@lang(' Text ')</label>
                            <div class="mb-3">
                                <x-ckeditor name="body">{{ old('body') }}</x-ckeditor>
                            </div>
                            <p class="text-sm mb-0">مشاهده مستندات مربوط به این ویرایشگر متن <a href="https://ckeditor.com/ckeditor-5-builds/#classic">CKEditor</a>
                            </p>
                        </div>
                        @error('body')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="meta_tag_title">@lang(' Meta Tag Title ')</label>
                            <input value="{{ $page->meta_tag_title }}" type="text" class="form-control" id="meta_tag_title" name="tag_title" placeholder="{{__(' Meta Tag Title ')}}">
                        </div>
                        @error('tag_title')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="meta_description">@lang(' Meta Description ')</label>
                            <input value="{{ $page->meta_description }}" type="text" class="form-control" id="meta_description" name="description" placeholder="{{__(' Meta Description ')}}">
                        </div>
                        @error('description')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="meta_keywords">@lang(' Meta Keywords ')</label>
                            <input value="{{ $page->meta_printable_keywords }}" type="text" class="form-control" id="meta_keywords" name="keywords" placeholder="{{__(' Meta Keywords ')}}">
                            <small class="help-text">@lang(' Seperate with . ')</small>
                        </div>
                        @error('keywords')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <button type="submit" class="btn btn-success">@lang(' Update ')</button>
                    </form>
                </div>
            </div>

            <!-- /.card -->
        </div>
    </div>
</section>
@endsection
