@extends('admin::app')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                @if($user->trashed())

                <section>

                    <div class="alert alert-info">
                        @lang(' User :user is already deleted, do you want to restore it?! ',[
                        'user' => $user->name,
                        ])
                    </div>

                    <form class="my-4" method="POST" action="{{ route("admin.users.restore", [
                    'user' => $user,
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
                        @lang(" Delete User permenently?! All data and its constraints will be deleted! ")
                    </div>

                    <form class="my-4" method="POST" action="{{ route("admin.users.force-destroy", [
                    'user' => $user,
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
                    @lang(' User :user will be deleted, are you sure?! ',[
                    'user' => $user->name,
                    ])
                </div>

                <form method="POST" action="{{ route("admin.users.destroy", [
                    'user' => $user,
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