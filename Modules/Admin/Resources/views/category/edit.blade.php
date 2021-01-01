@extends('admin::app')

@section('content')
<div class="container">
    <div class="card mb-6">
        <div class="card-body register-card-body">
            <p class="login-box-msg">ثبت دسته بندی جدید</p>

            <form action="{{ route("admin.category.edit", $category->id) }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input value="{{ $category->title }}" name="title" type="text" class="form-control" placeholder="عنوان">
                    <div class="input-group-append">
                        <span class="fa fa-heading input-group-text"></span>
                    </div>
                </div>
                @error('title')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3">
                    {{-- <label class="col-12" for="exampleFormControlSelect2">انتخاب دسته بندی والد</label>--}}
                    <label class="col-12" for="exampleFormControlSelect1">انتخاب دسته بندی والد</label>
                    <select class="form-control" name="parent_id" id="exampleFormControlSelect1">
                        <option value="">{{__('No Parent')}}</option>
                        @foreach ($categories as $categorySelect)
                            @if($categorySelect->id != $category->id && !$category->isAncestorOf($categorySelect))
                            <option 
                                @if($category->parent_id==$categorySelect->id)
                                    selected
                                @endif
                                value="{{$categorySelect->id}}">{{$categorySelect->bread_crumb}}</option>
                            @endif
                        @endforeach
                        
                    </select>
                </div>

                @error('parent_id')

                <p class="alert alert-danger">{{ $message }}</p>
                @enderror

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
