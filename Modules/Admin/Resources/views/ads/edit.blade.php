@extends('admin::app')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang(' edit Ad ')</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="edit-ad-form" action="{{ route("admin.ads.edit", $ad) }}" method="POST" role="form">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">@lang(' Title ')</label>
                                <input value="{{ $ad->title }}" type="text" class="form-control" id="title" name="title" placeholder="{{__(' Title ')}}">
                            </div>
                            @error('title')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label for="description">@lang(' Description ')</label>
                                <input value="{{ $ad->description }}" type="description" class="form-control" id="description" name="description" placeholder="{{__(' Description ')}}">
                            </div>
                            @error('description')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <x-admin-contact-form :contacts="$ad->contacts" formId="edit-ad-form"></x-admin-contact-form>

                            @error('value')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label for="price">@lang(' Price ')</label>
                                <input value="{{ floor($ad->price) }}" type="number" class="form-control" id="price" name="price" placeholder="{{__(' Price ')}}">
                                <small id="price_help" class="form-text text-muted"></small>
                            </div>
                            @error('price')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <!-- select -->
                            <div class="form-group">
                                <label for="models-search">@lang(' Choose Model ')</label>

                                <x-auto-complete-search :options="$models" :single="true" id="models-search" name="model_id" :route="route('admin.ads.models.search')" placeholder="{{__(' Choose Model ')}}" :defaults="$ad->phone_model_id">
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
                                    <option value="{{ $accessory->id }}" @if(in_array($accessory->id, $selected_accessories)) selected @endif>{{ __('user::accessories.'. $accessory->title) }}</option>
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
                                    <option value="{{ $age->id }}" @if($age->id == $ad->phone_age_id) selected @endif>{{ $age->printableName }}</option>
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
                                    <option value="{{ $variant->id }}" @if($variant->id == $ad->phone_model_variant_id) selected @endif>{{ $variant->printableName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('variant_id')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-check my-2">
                                <input type="checkbox" class="form-check-input" @if($ad->is_multicard) checked @endif name="is_multicard" id="is_multicard">
                                <label class="form-check-label" for="is_multicard">
                                    @lang(' Multicard ')
                                </label>
                            </div>

                            <div class="form-check my-2">
                                <input type="checkbox" class="form-check-input" name="is_exchangeable" @if($ad->is_exchangeable) checked @endif id="is_exchangeable">
                                <label class="form-check-label" for="is_exchangeable">
                                    @lang(' Exchangeable ')
                                </label>
                            </div>

                            <!-- select -->
                            <div class="form-group">
                                <label for="states-search">@lang(' Choose State ')</label>

                                <x-auto-complete-search :options="$states" :single="true" id="states-search" name="state_id" :route="route('admin.ads.states.search')" placeholder="{{__(' Choose State ')}}" :defaults="$ad->state_id">
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
        $('#price_help').html(calcPrice($('#price').val()))

        $('#price').on('keyup', function(e) {
            $('#price_help').html(calcPrice($(this).val()))
        })

    })
</script>
@endpush
