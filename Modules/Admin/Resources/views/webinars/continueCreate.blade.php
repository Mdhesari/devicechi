@extends('admin::app')

@section('content')
<div class="container">
    <div class="card p-4">
        <div class="card-title">
            <h4>لیست جلسات</h4>
        </div>

        <div class="card-body">
            <table class="table mb-4">
                <thead>
                    <tr>
                        <th scope="col">عنوان جلسه</th>
                        <th scope="col">زمان شروع جلسه</th>
                        <th scope="col">زمان پایان جلسه</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($webinar->lessons as $lesson)
                    <tr>
                        <td>{{$lesson->title}}</td>
                        <td>{{$lesson->start_time_at}}</td>
                        <td>{{$lesson->end_time_at}}</td>
                        <td>
                            <form action="{{ route('admin.lesson.delete', [$webinar->id, $lesson->id]) }}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block btn-flat mb-2">حذف</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <form class="mt-4" action="{{ route('admin.lesson.store', $webinar->id) }}" method="post">
                <h5 class="mb-3 mt-4">ایجاد جلسه جدید</h5>
                @csrf
                <div class="row">
                    <div class="input-group mb-3 col-md-3">
                        <input value="{{ old('title') }}" name="title" type="text" class="form-control"
                            placeholder="عنوان">
                        <div class="input-group-append">
                            <span class="fa fa-heading input-group-text"></span>
                        </div>
                    </div>

                    {{--Date Area--}}
                    <div class="input-group mb-3 col-md-3">
                        @include('admin::components.persianDatepicker', ['name' => 'start_time_at',
                        'placeholder' => 'زمان شروع جلسه'])
                    </div>
                    <div class="input-group mb-3 col-md-3">
                        @include('admin::components.persianDatepicker', ['name' => 'end_time_at',
                        'placeholder' => 'زمان پایان جلسه'])
                    </div>

                    <!-- /.col -->
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary btn-block btn-flat mb-2">ثبت</button>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-md-3">
                        @error('title')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        @error('start_time_at')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        @error('end_time_at')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card p-4">
        <div class="card-title">
            <h4>لیست بلیط ها</h4>
        </div>

        <div class="card-body">
            <table class="table mb-4">
                <thead>
                    <tr>
                        <th scope="col">عنوان بلیط</th>
                        <th scope="col">قیمت</th>
                        <th scope="col">تعداد</th>
                        <th scope="col">زمان شروع فروش</th>
                        <th scope="col">زمان پایان فروش</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($webinar->tickets as $ticket)
                    <tr>
                        <td>{{$ticket->title}}</td>
                        <td>{{$ticket->price}}</td>
                        <td>{{$ticket->limit}}</td>
                        <td>{{$ticket->start_sell_time}}</td>
                        <td>{{$ticket->end_sell_time}}</td>
                        <td>
                            <form action="{{ route('admin.ticket.delete', [$webinar->id, $ticket->id]) }}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block btn-flat mb-2">حذف</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <form class="mt-4" action="{{ route('admin.ticket.store', $webinar->id) }}" method="post">
                <h5 class="mb-3 mt-4">ایجاد جلسه جدید</h5>
                @csrf
                <div class="row">
                    <div class="input-group mb-3 col-md-2">
                        <input value="{{ old('title') }}" name="title" type="text" class="form-control"
                            placeholder="عنوان">
                        <div class="input-group-append">
                            <span class="fa fa-heading input-group-text"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3 col-md-2">
                        <input value="{{ old('price') }}" name="price" type="number" class="form-control"
                            placeholder="قیمت">
                        <div class="input-group-append">
                            <span class="fa fa-heading input-group-text"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3 col-md-2">
                        <input value="{{ old('limit') }}" name="limit" type="number" class="form-control"
                            placeholder="تعداد">
                        <div class="input-group-append">
                            <span class="fa fa-heading input-group-text"></span>
                        </div>
                    </div>

                    {{--Date Area--}}
                    <div class="input-group mb-3 col-md-3">
                        @include('admin::components.persianDatepicker', ['name' => 'start_sell_time',
                        'placeholder' => 'زمان شروع فروش'])
                    </div>
                    <div class="input-group mb-3 col-md-3">
                        @include('admin::components.persianDatepicker', ['name' => 'end_sell_time',
                        'placeholder' => 'زمان پایان فروش'])
                    </div>

                    <!-- /.col -->
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary btn-block btn-flat mb-2">ثبت</button>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-md-2">
                        @error('title')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        @error('price')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        @error('limit')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        @error('start_sell_time')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        @error('end_sell_time')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card p-4">
        <div class="card-title">
            <h4>لیست مجری ها</h4>
        </div>

        <div class="card-body">
            <table class="table mb-4">
                <thead>
                    {{--TODO::users field & must be clickable--}}
                    <tr>
                        <th scope="col">نام</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($webinar->moderators as $moderator)
                    <tr>
                        <td>{{$moderator->name}}</td>
                        <td>
                            <form action="{{ route('admin.webinar.remove-moderator', $webinar->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger btn btn-flat mb-2">حذف</button>
                                <div class="input-group" style="display: none">
                                    <label class="col-12" for="exampleFormControlSelect2">انتخاب مجری ها</label>
                                    <select multiple class="form-control" name="moderators[]"
                                        id="exampleFormControlSelect2">
                                        <option selected value="{{$moderator->id}}">{{$moderator->name}}</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <form class="mt-4" action="{{ route('admin.webinar.add-moderator', $webinar->id) }}" method="post">
                <h5 class="mb-3 mt-4">اضافه کردن مجری</h5>
                @csrf
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        {{--TODO::users must be searchable--}}
                        <label class="col-12" for="exampleFormControlSelect2">انتخاب مجری ها</label>
                        <select multiple class="form-control" name="moderators[]" id="exampleFormControlSelect2">
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat mb-2">ثبت</button>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-md-2">
                        @error('moderators')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card p-4">
        <div class="card-title">
            <h4>کاور وبینار</h4>
        </div>

        <div class="card-body">
            @if($webinar->cover)
            <div class="card-img-top">
                <img src="{{ Storage::url($webinar->cover) }}" style="width:100%;" alt="Card image cap">
                <div class="top-left" style="
                                                position: absolute;
                                                top: 10%;
                                                left: 10%;
                                                ">
                    <form action="{{route('admin.webinar.remove-cover', [$webinar->id, $webinar->cover()->id])}}"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn btn-flat mb-2">حذف</button>
                        <div class="input-group" style="display: none">

                        </div>
                    </form>
                </div>
            </div>
            @endif
            <form class="mt-4" action="{{ route('admin.webinar.add-cover', $webinar->id) }}"
                enctype="multipart/form-data" method="post">
                <h5 class="mb-3 mt-4">اضافه کردن کاور</h5>
                @csrf
                <div class="row">
                    <div class="input-group mb-3 col-md-12">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="cover" required>
                        <label class="custom-file-label" for="validatedCustomFile">اضافه کردن کاور</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat mb-2">ثبت</button>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-md-2">
                        @error('cover')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card p-4">
        <div class="card-title">
            <h4>لیست پرسش و پاسخ</h4>
        </div>

        <div class="card-body">
            <table class="table mb-4">
                <thead>
                    <tr>
                        <th scope="col">پرسش</th>
                        <th scope="col">پاسخ</th>
                        <th scope="col">حذف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($webinar->faqs as $faq)
                    <tr>
                        <td>{{$faq->question}}</td>
                        <td>{{$faq->answer}}</td>
                        <td>
                            <form action="{{ route('admin.faq.delete', [$webinar->id, $faq->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block btn-flat mb-2">حذف</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <form class="mt-4" action="{{ route('admin.faq.store', $webinar->id) }}" method="post">
                <h5 class="mb-3 mt-4">ایجاد جلسه سؤال جدید</h5>
                @csrf
                <div class="row">
                    <div class="input-group mb-3 col-md-3">
                        <textarea value="{{ old('question') }}" name="question" type="tel" class="form-control"
                            placeholder="پرسش"></textarea>
                        <div class="input-group-append">
                            <span class="fa fa-file-alt input-group-text"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3 col-md-3">
                        <textarea value="{{ old('answer') }}" name="answer" type="tel" class="form-control"
                            placeholder="پاسخ"></textarea>
                        <div class="input-group-append">
                            <span class="fa fa-file-alt input-group-text"></span>
                        </div>
                    </div>

                    <!-- /.col -->
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary btn-block btn-flat mb-2">ثبت</button>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-md-3">
                        @error('title')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        @error('start_time_at')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        @error('end_time_at')
                        <p class="alert alert-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if($webinar->is_filled)
    <div class="card p-4">
        <form class="mt-4" action="{{ route('admin.webinar.submit', $webinar->id) }}" method="post">
            @csrf
            <div class="row">

                <!-- /.col -->
                <div class="col-md-12" action="{{ route('webinar.submit', $webinar->id) }}">
                    <button type="submit" class="btn btn-success btn-block btn-flat mb-2">ثبت نهایی</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    @endif
</div>
@endsection