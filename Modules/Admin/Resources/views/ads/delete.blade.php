@extends('admin::app')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                @if($ad->trashed())

                <section>

                    <div class="alert alert-info">
                        @lang(' Ad :ad is already deleted, do you want to restore it?! ',[
                        'ad' => $ad->name,
                        ])
                    </div>

                    <form class="my-4" method="POST" action="{{ route("admin.ads.restore", [
                    'ad' => $ad->id,
                ]) }}">
                        @method('PUT')
                        @csrf

                        <button type="submit" class="btn btn-primary">
                            @lang(' Restore ')
                        </button>
                    </form>

                </section>

                <section>

                    <div class="alert alert-warning">
                        @lang(" Delete ad permenently?! All data and its constraints will be deleted! ")
                    </div>

                    <form class="my-4" method="POST" action="{{ route("admin.ads.force-destroy", [
                    'ad' => $ad->id,
                ]) }}">
                        @method('Delete')
                        @csrf

                        <button type="submit" class="btn btn-danger">
                            @lang(' Force Delete ')
                        </button>

                    </form>

                </section>


                @else


                <div class="alert alert-warning">
                    @lang(' ad :ad will be deleted, are you sure?! ',[
                    'ad' => $ad->title,
                    ])
                </div>

                <form method="POST" action="{{ route("admin.ads.destroy", [
                    'ad' => $ad,
                ]) }}">
                    @method('DELETE')
                    @csrf

                    <button type="submit" class="btn btn-danger">
                        @lang(' Delete ')
                    </button>
                </form>

                @endif

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
