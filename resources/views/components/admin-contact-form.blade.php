<div id="{{ $id }}" class="form-group">
                                <label for="contact-value" class="mb-3">@lang(' Add Contact ')</label>
                                <select class="d-none" multiple name="contacts[]" id="contacts-select"></select>
                                <div id="forms-holder" class="input-group">

                                    @if(count($contacts) < 1)
                                    <x-admin-add-contact-form></x-admin-add-contact-form>
                                    @endif

                                    @foreach ($contacts as $contact)
                                    <x-admin-add-contact-form :contact="$contact"></x-admin-add-contact-form>
                                    @endforeach
                                </div>
                                <button id="add-contact" type="button" class="btn btn-primary my-4">@lang(' Add New + ')</button>
                            </div>


@push('add_scripts')

<script>
const formId = '#{{ $formId }}'

      $('#forms-holder').on('click', '.delete-contact', function(e) {
            if ($('.add-contact-form').length > 1) {
                $(this).parent().remove()
            }
        })


        $('#add-contact').on('click', function(e) {
            appendNewContactFormToContactsHolder()
        })

    $(formId).on('submit', function(e) {
            if (validateCreateAdForm()) {
                return true;
            }

            e.preventDefault();

            storeContactsToHiddenSelect()

            if (validateCreateAdForm())
                $(this).submit()
        })

function appendNewContactFormToContactsHolder() {
            const $clone = $('.add-contact-form').first().clone()

            $clone.find('input').val('')

            $clone.appendTo('#forms-holder')
        }

        function storeContactsToHiddenSelect() {
            const hiddenSelect = $('#contacts-select')
            let options = []

            const forms = $('.add-contact-form')

            forms.each(function(index) {
                const $this = $(this)

                let text = $this.find('.contact-value').val(),
                    value = $this.find('select').find(':selected').val()

                value += ':' + text

                if (text.length > 0) {
                    let opt = new Option(text, value)
                    opt.selected = true
                    options.push(opt)
                }
            })

            hiddenSelect.append(options)
        }

        function validateCreateAdForm() {
            return $('#contacts-select').find('option').length > 0
        }
</script>

@endpush
