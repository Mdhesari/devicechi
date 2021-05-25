@extends('admin::app')

@section('content')
<section class="content">
    <div class="row">
        <!-- form start -->
        <form id="create-post-form" class="row w-100 m-0" action="{{ route("admin.posts.create") }}" method="POST" role="form" enctype="multipart/form-data">
            @csrf
            <div class="col-12 col-md-8">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            @lang(' Create Post ')
                        </h3>
                        <!-- tools box -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">@lang(' Title ')</label>
                            <input value="{{ old('title') }}" type="text" class="form-control form-control-lg" id="title" name="title" placeholder="{{__(' Title ')}}">
                        </div>
                        @error('title')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="editor">@lang(' Text ')</label>
                            <div class="mb-3">
                                <x-tinymce name="body">{{ old('body') }}</x-tinymce>
                            </div>
                        </div>
                        @error('body')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="editor">@lang(' Excerpt ')</label>
                            <div class="mb-3">
                                <textarea rows="9" name="excerpt" class="form-control">{{ old('excerpt') }}</textarea>
                            </div>
                        </div>
                        @error('excerpt')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            @lang(' Status ')
                        </h3>
                        <!-- tools box -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <div class="form-group">
                            <select name="status" id="status" class="form-control">
                                @foreach ($statusList as $status)
                                <option value="{{ $status['value'] }}">{{ $status['title'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('status')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <x-slug-form textFormId="title" modelClass="-App-Models-Post"></x-slug-form>

                        @error('slug')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input pl-3" name="is_favourite" id="is_favourite">
                            <label for="is_favourite" class="form-check-label">نمایش در اسلایدر</label>
                        </div>

                        @error('is_favourite')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            @lang(' Featured Image ')
                        </h3>
                        <!-- tools box -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <div class="form-group">
                            <div class="image-preview mb-2 d-none">
                                <img class="rounded" src="" style="width: 140px;height:140px;max-width:100%;" alt="">
                            </div>
                            <input type="file" class="form-control" id="featured_image" name="featured_image">
                        </div>
                        @error('featured-image')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            @lang(' Meta ')
                        </h3>
                        <!-- tools box -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="form-group">
                            <label for="meta_tag_title">@lang(' Meta Tag Title ')</label>
                            <input value="{{ old('tag_title') }}" type="text" class="form-control" id="meta_tag_title" name="tag_title" placeholder="{{__(' Meta Tag Title ')}}">
                        </div>
                        @error('tag_title')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="meta_description">@lang(' Meta Description ')</label>
                            <input value="{{ old('description') }}" type="text" class="form-control" id="meta_description" name="description" placeholder="{{__(' Meta Description ')}}">
                        </div>
                        @error('description')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="meta_keywords">@lang(' Meta Keywords ')</label>
                            <input value="{{ old('keywords') }}" type="text" class="form-control" id="meta_keywords" name="keywords" placeholder="{{__(' Meta Keywords ')}}">
                            <small class="help-text">@lang(' Seperate with . ')</small>
                        </div>
                        @error('keywords')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-success" onclick="$('#create-post-form').submit()">@lang(' Save ')</button>
            </div>
        </form>
    </div>
</section>
@endsection
