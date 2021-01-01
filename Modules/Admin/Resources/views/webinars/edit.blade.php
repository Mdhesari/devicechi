@extends('admin::app')

@section('content')
    <div class="container">
        <div class="card mb-6">
            <div class="card-body register-card-body">
                <p class="login-box-msg">ویرایش وبینار</p>

                <form action="{{ route("admin.webinar.update", $webinar->id) }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input value="{{ $webinar->title }}" name="title" type="text" class="form-control"
                               placeholder="عنوان">
                        <div class="input-group-append">
                            <span class="fa fa-heading input-group-text"></span>
                        </div>
                    </div>
                    @error('title')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-3">
                        <input value="{{ $webinar->description }}" name="description" type="text" class="form-control"
                               placeholder="توضیحات">
                        <div class="input-group-append">
                            <span class="fa fa-file-alt input-group-text"></span>
                        </div>
                    </div>
                    @error('description')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-3">
                        <label class="col-12" for="exampleFormControlSelect2">انتخاب دسته بندی ها</label>
                        <select multiple class="form-control" name="categories[]" id="exampleFormControlSelect2">
                            @foreach ($categories as $category)

                                <option @if($webinar->categories()->get()->contains($category->id))
                                        selected
                                        @endif
                                        value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('categories')

                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                    <div class="form-check mb-3 mr-4">
                        <input type="checkbox" class="form-check-input mb-3" name="is_public" value="1"
                               id="exampleCheck1"
                               @if($webinar->is_public)
                               checked
                                @endif >
                        <label class="form-check-label" fon="exampleCheck1">وبینار عمومی است</label>
                    </div>
                    <!-- /.col -->
                    <div>
                        <button type="submit" class="btn btn-primary btn-block btn-flat mb-2">ثبت</button>
                    </div>
                    <!-- /.col -->
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

