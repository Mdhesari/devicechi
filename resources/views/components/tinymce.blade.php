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

        $('#{{ $id }}').html(`
            {{ $slot }}
            `)

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


        var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

        tinymce.init({
            // images_upload_url: upload_url,
            height: 500,
            selector: '#{{ $id }}',


            plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            mobile: {
                plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons'
            },
            menubar: 'file edit view insert format tools table tc help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor casechange removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            // link_list: [{
            //         title: 'My page 1',
            //         value: 'https://www.tiny.cloud'
            //     },
            //     {
            //         title: 'My page 2',
            //         value: 'http://www.moxiecode.com'
            //     }
            // ],
            // image_list: [{
            //         title: 'My page 1',
            //         value: 'https://www.tiny.cloud'
            //     },
            //     {
            //         title: 'My page 2',
            //         value: 'http://www.moxiecode.com'
            //     }
            // ],
            image_class_list: [{
                    title: 'None',
                    value: ''
                },
                {
                    title: 'Some class',
                    value: 'class-name'
                }
            ],
            importcss_append: true,
            templates: [{
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {
                    title: 'Starting my story',
                    description: 'A cure for writers block',
                    content: 'Once upon a time...'
                },
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            spellchecker_ignore_list: ['Ephox', 'Moxiecode'],
            contextmenu: 'link image imagetools table configur',
            a11y_advanced_options: true,
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
            /*
            The following settings require more configuration than shown here.
            For information on configuring the mentions plugin, see:
            https://www.tiny.cloud/docs/plugins/premium/mentions/.
            */
            // mentions_selector: '.mymention',
            // mentions_fetch: mentions_fetch,
            // mentions_menu_hover: mentions_menu_hover,
            // mentions_menu_complete: mentions_menu_complete,
            // mentions_select: mentions_select,
            // mentions_item_type: 'profile',

            language: 'fa_IR',
            language_url: '{{ asset('tinymce/langs/fa_IR.js') }}',
            font_formats: "Vazir",
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
            // toolbar: 'undo redo | styleselect | bold italic | link image | fullscreen',
            // plugins: [
            //     'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
            //     'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            //     'save table contextmenu directionality emoticons template paste textcolor'
            // ],
        });

        // // tinymce.activeEditor.uploadImages(function (success) {
        // //     $.post('{{ route('admin.tinymce.upload') }}', tinymce.activeEditor.getContent()).done(function () {
        // //         console.log("Uploaded images and posted content as an ajax request.");
        // //     });
        // });
    </script>
@endpush
