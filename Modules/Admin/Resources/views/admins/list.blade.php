@extends('admin::app')

@push('add_styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
@endpush

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header row">

                    <a class="btn btn-link" href="{{ route("admin.users.add") }}">
                        <i class="fa fa-plus-square" style="font-size: 24px;vertical-align:middle;"></i>
                    </a>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="users-list" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>
                                    @lang(' Number ')
                                </th>
                                <th>
                                    @lang(' Name ')
                                </th>
                                <th>
                                    @lang(' Email ')
                                </th>
                                <th>
                                    @lang(' Role ')
                                </th>
                                <th>
                                    @lang(' Submission Date ')
                                </th>
                                <th>
                                    @lang(' Actions ')
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($admins as $admin)

                            <tr>

                                <td>{{ ++$loop->index }}</td>

                                <td>{{ $admin->name }} </td>

                                <td>{{ $admin->email }}</td>

                                <td>{{ $admin->roles_as_string }}</td>


                                <td>{{ $admin->created_at }}</td>



                                <td>
                                    <div class="btn-group" role="group" aria-label="Admin actions">
                                        @can('create user')
                                        <a href="{{ route("admin.admins.edit", ['admin' => $admin]) }}"
                                            class="btn btn-secondary">
                                            <i class="fa fa-pencil" style="vertical-align:middle;"></i>
                                        </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>
                                    @lang(' Number ')
                                </th>
                                <th>
                                    @lang(' Name ')
                                </th>
                                <th>
                                    @lang(' Email ')
                                </th>
                                <th>
                                    @lang(' Role ')
                                </th>

                                <th>
                                    @lang(' Submission Date ')
                                </th>

                            </tr>
                        </tfoot>
                    </table>

                    {!! $admins->links() !!}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection

@push('add_scripts')

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

<script>
    $(document).ready( function () {
    $('#users-list').DataTable({
        paging: false,
    });
} );
</script>

@endpush