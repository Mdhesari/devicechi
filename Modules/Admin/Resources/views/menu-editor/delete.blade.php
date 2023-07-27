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
                    @lang(' Menu :menu will be deleted, are you sure?! ',[
                    'menu' => $menu->renderName(),
                    ])
                </div>

                <form method="POST" action="{{ route("admin.menu-editor.delete.group", [
                    'menu' => $menu,
                ]) }}">
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
