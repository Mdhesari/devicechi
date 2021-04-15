@extends('admin::app')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="alert alert-warning">
                    <h4 class="alert-heading">@lang(' Warning! ')</h4>
                    <hr>
                    @lang(' Page :page will be deleted, are you sure?! ',[
                    'page' => $page->renderName(),
                    ])
                </div>

                <form method="POST" action="{{ route("admin.pages.destroy", $page) }}">
                    @method('DELETE')
                    @csrf

                    <button type="submit" class="btn btn-danger">
                        @lang(' Delete ')
                    </button>
                </form>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
