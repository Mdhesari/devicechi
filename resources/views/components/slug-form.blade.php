<div class="form-group">
    <label for="slug">@lang(' Slug ')</label>
    <input value="{{ old('slug') }}" type="text" class="form-control form-control" id="slug"
        name="slug" placeholder="{{ __(' Slug ') }}">
</div>

@push('add_scripts')
    <script>
        const textForm = $('#{{ $textFormId }}')
        const slugForm = $('#slug')
        slugForm.val('{{ $slug }}')
        textForm.on('blur', updateSlug)

        function updateSlug(params) {
            const className = '{{ $modelClass }}'

            $.get('{{ route('admin.slug.generate') }}', {
                slug: textForm.val(),
                className,
            }).then(slug => {
                slugForm.val(slug)
            })
        }
    </script>
@endpush
