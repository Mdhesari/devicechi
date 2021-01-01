@extends('admin::app')

@section('content')
    <div class="container">
        <div class="card mb-6">
            <div class="card-body register-card-body">
                <p class="login-box-msg">ثبت وبینار جدید</p>

                <form action="{{ route("admin.webinar.store") }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input value="{{ old('title') }}" name="title" type="text" class="form-control"
                               placeholder="عنوان">
                        <div class="input-group-append">
                            <span class="fa fa-heading input-group-text"></span>
                        </div>
                    </div>
                    @error('title')
                    <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-3">
                        <input value="{{ old('description') }}" name="description" type="text" class="form-control"
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
                            <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('categories')

                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                    <div class="form-check mb-3 mr-4">
                        <input type="checkbox" class="form-check-input mb-3" name="is_public" value="1" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">وبینار عمومی است</label>
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

