<div>
    <!-- Well begun is half done. - Aristotle -->
    <textarea id="{{ $id }}" name="{{ $name }}"></textarea>
</div>

@push('add_scripts')
    <script src="https://cdn.tiny.cloud/1/jmly2xt7k5xq9eqpt8k49hsbhvqmzz7qxqauj1av71dn2flx/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        const upload_url = '{{ route('admin.tinymce.upload') }}',
            csrf_token = '{{ csrf_token() }}'

        $('#{{ $id }}').html(fixGivenString('{{ $slot }}'))

        function fixGivenString(str) {
            	const persianNumbers = [
					/۰/g,
					/۱/g,
					/۲/g,
					/۳/g,
					/۴/g,
					/۵/g,
					/۶/g,
					/۷/g,
					/۸/g,
					/۹/g
				],
				arabicNumbers = [
					/٠/g,
					/١/g,
					/٢/g,
					/٣/g,
					/٤/g,
					/٥/g,
					/٦/g,
					/٧/g,
					/٨/g,
					/٩/g
				]
			if (typeof str === 'string') {
				for (let i = 0; i < 10; i++) {
					str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i)
				}
			}
			return str
        }

        tinymce.init({
            // images_upload_url: upload_url,
            height: 500,
            selector: '#{{ $id }}',
            language: 'fa_IR',
            language_url: '{{ asset('tinymce/langs/fa_IR.js') }}',
            toolbar: 'undo redo | styleselect | bold italic | link image | fullscreen',
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor'
            ],
            font_formats: "Vazir",
            content_style: "body { font-family: Vazir; }",
            content_css: '{{ asset('tinymce/content.css') }}',
            content_style: "@import url('https://cdnjs.cloudflare.com/ajax/libs/vazir-font/28.0.0/font-face.css');",
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', upload_url);
                xhr.setRequestHeader("X-CSRF-Token", csrf_token);
                xhr.onload = function () {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            }
        });

        // // tinymce.activeEditor.uploadImages(function (success) {
        // //     $.post('{{ route('admin.tinymce.upload') }}', tinymce.activeEditor.getContent()).done(function () {
        // //         console.log("Uploaded images and posted content as an ajax request.");
        // //     });
        // });
    </script>
@endpush
