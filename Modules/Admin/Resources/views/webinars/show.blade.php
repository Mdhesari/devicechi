@extends('admin::app')

@section('content')
<div class="container">

    <div class="jumbotron p-3 p-md-5 text-white rounded">
      <div class="col-md-12 px-0">
        <img src="{{ Storage::url($webinar->cover) }}" style="width:100%;" alt="Card image cap">

      </div>
    </div>
    <div class="blog-post">
        <h2 class="blog-post-title">{{$webinar->title}}</h2>

        <p>{{$webinar->description}}</p>
        <hr>
    </div>
    <div class="blog-post">
      <h3 class="blog-post-title">دسته بندی ها</h3>

      <p>
        @foreach ($webinar->categories as $category)
            {{$category->title}},
        @endforeach
      </p>
      <hr>
  </div>
    <div class="blog-post">
        <h4 class="blog-post-title">مجری ها</h4>
    </div>
    <div class="row mb-2">
      @foreach ($webinar->moderators as $moderator)
      <div class="col-2">
      <div class="card mr-2" >
        <img class="card-img-top" src="{{ Storage::url($moderator->image ?? $webinar->cover) }}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{$moderator->name}}</h5>
          {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
          {{-- //TODO: must be redirect to user profile --}}
          <a href="#" class="mt-3 btn btn-primary">پروفایل کاربر</a>
        </div>
      </div>
      </div> 
      @endforeach
      
    </div>
  </div>

  <main role="main" class="container">
    <div class="row">
      <div class="col-md-8 blog-main">
        <table class="table mb-4">
          <thead>
              <tr>
                  <th scope="col">عنوان جلسه</th>
                  <th scope="col">زمان شروع جلسه</th>
                  <th scope="col">زمان پایان جلسه</th>
              </tr>
          </thead>
          <tbody>
              @foreach($webinar->lessons as $lesson)
              <tr>
                  <td>{{$lesson->title}}</td>
                  <td>{{$lesson->start_time_at}}</td>
                  <td>{{$lesson->end_time_at}}</td>
              </tr>
              @endforeach
          </tbody>
      </table>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-8 blog-main">
        <h3>لیست بلیط ها</h3>
          <table class="table mb-4">
                <thead>
                    <tr>
                        <th scope="col">عنوان بلیط</th>
                        <th scope="col">قیمت</th>
                        <th scope="col">تعداد</th>
                        <th scope="col">زمان شروع فروش</th>
                        <th scope="col">زمان پایان فروش</th>
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
                    </tr>
                    @endforeach
                </tbody>
          </table>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-8 blog-main">
        <h3>لیست پرسش و پاسخ ها</h3>
        <table class="table mb-4">
          <thead>
              <tr>
                  <th scope="col">پرسش</th>
                  <th scope="col">پاسخ</th>
              </tr>
          </thead>
          <tbody>
              @foreach($webinar->faqs as $faq)
              <tr>
                  <td>{{$faq->question}}</td>
                  <td>{{$faq->answer}}</td>
              </tr>
              @endforeach
          </tbody>
      </table>
      </div>
    </div>
    
        <div class="row">
      <div class="col-md-8 blog-main">
        <form class="mt-4" action="{{ route('admin.webinars.change-status', $webinar->id) }}" method="post">
          <h5 class="mb-3 mt-4">تغییر وضعیت</h5>
          @csrf
          <div class="row">
              <div class="input-group mb-3 col-md-12">
                  {{--TODO::users must be searchable--}}
                  <select class="form-control" name="status" id="exampleFormControlSelect2">
                      @foreach ($status as $key => $value)
                      <option value="{{$key}}"
                      @if($webinar->status == $key)
                        selected
                      @endif
                      >
                        {{__($value)}}
                      </option>
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
      <!-- /.blog-post -->


      <aside class="col-md-4 blog-sidebar">
        <div class="p-3 mb-3 bg-light rounded">
         
        </div>

      </aside><!-- /.blog-sidebar -->
      <!-- /.row -->

  </main><!-- /.container -->


  @endsection
