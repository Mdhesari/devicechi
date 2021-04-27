@extends('admin::app')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang(' Create Ad ')</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-ad-form" action="{{ route("admin.ads.add") }}" method="POST" role="form">
                        @csrf

                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">@lang(' Title ')</label>
                                <input value="{{ old('title') }}" type="text" class="form-control" id="title" name="title" placeholder="{{__(' Title ')}}">
                            </div>
                            @error('title')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label for="description">@lang(' Description ')</label>
                                <input value="{{ old('description') }}" type="description" class="form-control" id="description" name="description" placeholder="{{__(' Description ')}}">
                            </div>
                            @error('description')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div id="contacts-form" class="form-group">
                                <label for="contact-value" class="mb-3">@lang(' Add Contact ')</label>
                                <select class="d-none" multiple name="contacts[]" id="contacts-select"></select>
                                <div id="forms-holder" class="input-group">
                                    <div class="input-group add-contact-form my-3" style="position:relative;">
                                        <button type="button" class="btn btn-link text-danger delete-contact" style="position: absolute;bottom:80%;right:0;z-index:29">
                                            <i class="fa fa-minus-circle"></i>
                                        </button>
                                        <input class="contact-value form-control w-50" type="text">
                                        <div class="input-group-prepend">
                                            <select class="form-control" name="contact-type" class="contact-type">
                                                @foreach ($contactTypes as $contactType)
                                                <option @if($loop->first) selected @endif value="{{ $contactType->id }}" title="{{ $contactType->description }}">{{ $contactType->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button id="add-contact" type="button" class="btn btn-primary my-4">@lang(' Add New + ')</button>
                            </div>

                            @error('value')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label for="price">@lang(' Price ')</label>
                                <input value="{{ old('price') }}" type="number" class="form-control" id="price" name="price" placeholder="{{__(' Price ')}}">
                                <small id="price_help" class="form-text text-muted"></small>
                            </div>
                            @error('price')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <!-- select -->
                            <div class="form-group">
                                <label for="models-search">@lang(' Choose Model ')</label>

                                <x-auto-complete-search :options="$models" :single="true" id="models-search" name="model_id" :route="route('admin.ads.models.search')" placeholder="{{__(' Choose Model ')}}" :defaults="old('model_id')">
                                </x-auto-complete-search>

                            </div>
                            @error('model_id')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <!-- select -->
                            <div class="form-group">
                                <label for="accessories">@lang(' Choose Accessories ')</label>

                                <select multiple name="accessories[]" id="accessories">
                                    @foreach ($accessories as $accessory)
                                    <option value="{{ $accessory->id }}">{{ __('user::accessories.'. $accessory->title) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('accessories')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <!-- select -->
                            <div class="form-group">
                                <label for="age">@lang(' Choose Age ')</label>

                                <select class="form-control" name="age_id" id="age">
                                    @foreach ($ages as $age)
                                    <option value="{{ $age->id }}">{{ $age->printableName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('age_id')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <!-- select -->
                            <div class="form-group">
                                <label for="variant">@lang(' Choose Variant ')</label>

                                <select class="form-control" name="variant_id" id="variant">
                                    @foreach ($variants as $variant)
                                    <option value="{{ $variant->id }}">{{ $variant->printableName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('variant_id')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="is_multicard" id="is_multicard">
                                <label class="form-check-label" for="is_multicard">
                                    @lang(' Multicard ')
                                </label>
                            </div>

                            <!-- select -->
                            <div class="form-group">
                                <label for="states-search">@lang(' Choose State ')</label>

                                <x-auto-complete-search :options="$states" :single="true" id="states-search" name="state_id" :route="route('admin.ads.states.search')" placeholder="{{__(' Choose State ')}}" :defaults="old('state_id')">
                                </x-auto-complete-search>

                            </div>
                            @error('state_id')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">@lang(' Save ')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@push('add_scripts')
<script>
    jQuery(function($) {
        $('#price').on('keyup', function(e) {
            $('#price_help').html(calcPrice($(this).val()))
        })

        $('#add-contact').on('click', function(e) {
            appendNewContactFormToContactsHolder()
        })

        $('#forms-holder').on('click', '.delete-contact', function(e) {
            if ($('.add-contact-form').length > 1) {
                $(this).parent().remove()
            }
        })

        $('#create-ad-form').on('submit', function(e) {
            if (validateCreateAdForm()) {
                return true;
            }

            e.preventDefault();

            storeContactsToHiddenSelect()

            // if (validateCreateAdForm())
            //     $(this).submit()
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
    })
</script>
@endpush
