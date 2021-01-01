@extends('admin::app')

@section('content')
<div class="container">
    <div class="card mb-6">
        <div class="card-body register-card-body">
            <p class="card-text">حذف دسته بندی {{$category->title}}</p>
            <p class="card-text">
                <ul class="list-group list-group-flush">
                @foreach ($category->children as $child)
                    <li class="list-group-item">{{$child->title}}</li>
                    @endforeach
                </ul>
            </p>
            <form action="{{ route("admin.category.destroy", $category->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="form-check mb-3 mr-4">
                        <input type="checkbox" class="form-check-input mb-3" name="delete_childs" value="1" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">تمام دسته بندی های وابسته پاک شود؟</label>
                    </div>
                <div>
                    <button type="submit" class="btn btn-danger btn-flat mb-2">حذف</button>
                </div>
                <!-- /.col -->
            </form>
        </div>
    </div>
</div>
</div>
@endsection
