@push('add_styles')
<style>
    .ck-editor__editable {
        min-height: 500px;
    }
</style>
@endpush

<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
    <textarea id="{{ $id }}" name="{{ $name }}" style="width: 100%" placeholder="متن خود را وارد کنید">{{ $slot }}</textarea>

</div>

@push('add_scripts')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace("{{ $id }}", {
        filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endpush
