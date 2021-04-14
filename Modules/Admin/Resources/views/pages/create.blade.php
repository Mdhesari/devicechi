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
                                <textarea id="editor" name="body" style="width: 100%" placeholder="متن خود را وارد کنید">{{ old('editor') }}</textarea>
                            </div>
                            <p class="text-sm mb-0">مشاهده مستندات مربوط به این ویرایشگر متن <a href="https://ckeditor.com/ckeditor-5-builds/#classic">CKEditor</a>
                            </p>
                        </div>
                        @error('body')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

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
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor', {
        filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
<!-- <script src="{{ asset('css/admin/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script> -->
<!--
<script>
    $(function() {

        class MyUploadAdapter {
            constructor(loader) {
                // The file loader instance to use during the upload.
                this.loader = loader;
            }

            // Starts the upload process.
            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }

            // Aborts the upload process.
            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }

            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();

                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
                xhr.open('POST', 'http://example.com/image/upload/path', true);
                xhr.responseType = 'json';
            }

            // Initializes XMLHttpRequest listeners.
            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener('error', () => reject(genericErrorText));
                xhr.addEventListener('abort', () => reject());
                xhr.addEventListener('load', () => {
                    const response = xhr.response;

                    // This example assumes the XHR server's "response" object will come with
                    // an "error" which has its own "message" that can be passed to reject()
                    // in the upload promise.
                    //
                    // Your integration may handle upload errors in a different way so make sure
                    // it is done properly. The reject() function must be called when the upload fails.
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }

                    // If the upload is successful, resolve the upload promise with an object containing
                    // at least the "default" URL, pointing to the image on the server.
                    // This URL will be used to display the image in the content. Learn more in the
                    // UploadAdapter#upload documentation.
                    resolve({
                        default: response.url
                    });
                });

                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', evt => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }

            // Prepares the data and sends the request.
            _sendRequest(file) {
                // Prepare the form data.
                const data = new FormData();

                data.append('upload', file);

                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.

                // Send the request.
                this.xhr.send(data);
            }
        }

        // ...

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter(loader);
            };
        }

        // Replace the <textarea id="editor"> with a CKEditor
        // instance, using default configuration.

        // CKEDITOR.replace('editor', {
        // filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
        // filebrowserUploadMethod: 'form'
        // })

        ClassicEditor
            .create(document.querySelector('#editor'), {
                cloudServices: {
                    tokenUrl: 'https://example.com/cs-token-endpoint',
                    uploadUrl: 'https://your-organization-id.cke-cs.com/easyimage/upload/'
                }
            })
            .then(function(editor) {
                // The editor instance
            })
            .catch(function(error) {
                console.error(error)
            })
    })
</script> -->
@endpush
