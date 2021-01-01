@extends('admin::app')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                @if($admin->trashed())

                <section>

                    <div class="alert alert-info">
                        @lang(' admin :admin is already deleted, do you want to restore it?! ',[
                        'admin' => $admin->name,
                        ])
                    </div>

                    <form class="my-4" method="POST" action="{{ route("admin.admins.restore", [
                    'admin' => $admin,
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
                        @lang(" Delete admin permenently?! All data and its constraints will be deleted! ")
                    </div>

                    <form class="my-4" method="POST" action="{{ route("admin.admins.force-destroy", [
                    'admin' => $admin,
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
                    @lang(' admin :admin will be deleted, are you sure?! ',[
                    'admin' => $admin->name,
                    ])
                </div>

                <form method="POST" action="{{ route("admin.admins.destroy", [
                    'admin' => $admin,
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