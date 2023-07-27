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
                    <table id="activities" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>
                                    @lang(' Number ')
                                </th>
                                <th>
                                    @lang(' Date ')
                                </th>
                                <th>
                                    @lang(' Log Type ')
                                </th>
                                <th>
                                    @lang(' Description ')
                                </th>
                                <th>
                                    @lang(' Done By ')
                                </th>
                                <th>
                                    @lang(' Actions ')
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($activities as $activity)

                            <tr>

                                <td>{{ ++$loop->index }}</td>

                                <td>{{ $activity->created_at->toFormattedDateString() }} </td>

                                <td>{{ $activity->log_name }}</td>

                                <td>{{ $activity->description }}</td>

                                <td> {{ $activity->causer->mobile ? $activity->causer->mobile:$activity->causer->email }}
                                </td>

                                <td>
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
                            @lang(' Date ')
                        </th>
                        <th>
                            @lang(' Log Type ')
                        </th>
                        <th>
                            @lang(' Done By ')
                        </th>
                        <th>
                            @lang(' Actions ')
                        </th>
                    </tr>
                </tfoot>
                </table>

                {!! $activities->links() !!}
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
    $('#activities').DataTable({
        paging: false,
    });
} );
</script>

@endpush