<div>
    <!-- Well begun is half done. - Aristotle -->
    <textarea id="{{ $id }}" name="{{ $name }}">{{ $slot }}</textarea>
</div>

@push('add_scripts')
    <script src="https://cdn.tiny.cloud/1/jmly2xt7k5xq9eqpt8k49hsbhvqmzz7qxqauj1av71dn2flx/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            images_upload_url: '{{ route('admin.tinymce.upload') }}',
            height: 500,
            selector: '#{{ $id }}',
            language: 'fa_IR',
            language_url: '{{ asset('tinymce/langs/fa_IR.js') }}',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
            ],
            font_formats: "Vazir",
            content_style: "body { font-family: Vazir; }",
            content_css: '{{ asset('tinymce/content.css') }}',
            content_style: "@import url('https://cdnjs.cloudflare.com/ajax/libs/vazir-font/28.0.0/font-face.css');",
            // images_upload_handler: function (blobInfo, success, failure) {
            //     var xhr, formData;
            //     xhr = new XMLHttpRequest();
            //     xhr.withCredentials = false;
            //     xhr.open('POST', '{{ route('admin.tinymce.upload') }}';
            //     var token = '{{ csrf_token() }}';
            //     xhr.setRequestHeader("X-CSRF-Token", token);
            //     xhr.onload = function () {
            //         var json;
            //         if (xhr.status != 200) {
            //             failure('HTTP Error: ' + xhr.status);
            //             return;
            //         }
            //         json = JSON.parse(xhr.responseText);

            //         if (!json || typeof json.location != 'string') {
            //             failure('Invalid JSON: ' + xhr.responseText);
            //             return;
            //         }
            //         success(json.location);
            //     };
            //     formData = new FormData();
            //     formData.append('file', blobInfo.blob(), blobInfo.filename());
            //     xhr.send(formData);
            // }
        });

        // tinymce.activeEditor.uploadImages(function (success) {
        //     $.post('{{ route('admin.tinymce.upload') }}', tinymce.activeEditor.getContent()).done(function () {
        //         console.log("Uploaded images and posted content as an ajax request.");
        //     });
        // });
    </script>
@endpush
