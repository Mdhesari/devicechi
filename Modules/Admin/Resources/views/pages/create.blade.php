@extends('admin::page')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        CKEditor5
                        <small>پیشرفته به همراه همه امکانات</small>
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
                    <div class="mb-3">
                        <textarea id="editor1" name="editor1" style="width: 100%">لطفا متن مورد نظر خودتان را وارد کنید</textarea>
                    </div>
                    <p class="text-sm mb-0">مشاهده مستندات مربوط به این ویرایشگر متن <a href="https://ckeditor.com/ckeditor-5-builds/#classic">CKEditor</a>
                    </p>
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
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(function(editor) {
                // The editor instance
            })
            .catch(function(error) {
                console.error(error)
            })

        // bootstrap WYSIHTML5 - text editor

        $('.textarea').wysihtml5({
            toolbar: {
                fa: true
            }
        })
    })
</script>
@endpush
