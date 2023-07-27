  <div class="input-group add-contact-form my-3" style="position:relative;">
                                        <button type="button" class="btn btn-link text-danger delete-contact" style="position: absolute;bottom:80%;right:0;z-index:29">
                                            <i class="fa fa-minus-circle"></i>
                                        </button>
                                        <input class="contact-value form-control w-50" type="text" value="{{ $contact->value }}">
                                        <div class="input-group-prepend">
                                            <select class="form-control" name="contact-type" class="contact-type">
                                                @foreach ($contactTypes as $contactType)
                                                <option @if($contact->contact_type_id == $contactType->id) selected @endif value="{{ $contactType->id }}" title="{{ $contactType->description }}">{{ $contactType->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
