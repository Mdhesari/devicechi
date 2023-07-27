@extends('admin::app')

@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        <div class="row">

            @foreach ($lists as $box)

            <x-admin-info-box :box="$box"></x-admin-info-box>

            @endforeach

        </div>

        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">
                            <i class="fa fa-pie-chart mr-1"></i>
                            فروش
                        </h3>
                        <ul class="nav nav-pills mr-auto p-2">
                            <li class="nav-item">
                                <a class="nav-link active" href="#revenue-chart" data-toggle="tab">@lang(' Diagram
                                    ')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#sales-chart" data-toggle="tab">@lang(' Chart ')</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="revenue-chart"
                                style="position: relative; height: 300px;"></div>
                            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- solid sales graph -->
                <div class="card bg-info-gradient">
                    <div class="card-header no-border">
                        <h3 class="card-title">
                            <i class="fa fa-th mr-1"></i>
                            نمودار فروش
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn bg-info btn-sm" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn bg-info btn-sm" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart" id="line-chart" style="height: 250px;"></div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer bg-transparent">
                        <div class="row">
                            <div class="col-4 text-center">
                                <input type="text" class="knob" data-readonly="true" value="20" data-width="60"
                                    data-height="60" data-fgColor="#39CCCC">

                                <div class="text-white">سفارش ایمیلی</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <input type="text" class="knob" data-readonly="true" value="50" data-width="60"
                                    data-height="60" data-fgColor="#39CCCC">

                                <div class="text-white">سفارش آنلاین</div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <input type="text" class="knob" data-readonly="true" value="30" data-width="60"
                                    data-height="60" data-fgColor="#39CCCC">

                                <div class="text-white">سفارش فیزیکی</div>
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

                <!-- Calendar -->
                <div class="card bg-success-gradient">
                    <div class="card-header no-border">

                        <h3 class="card-title">
                            <i class="fa fa-calendar"></i>
                            تقویم
                        </h3>
                        <!-- tools card -->
                        <div class="card-tools">
                            <!-- button with a dropdown -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                    data-toggle="dropdown">
                                    <i class="fa fa-bars"></i></button>
                                <div class="dropdown-menu float-right" role="menu">
                                    <a href="#" class="dropdown-item">رویداد تازه</a>
                                    <a href="#" class="dropdown-item">حذف رویدادها</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">نمایش تقویم</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success btn-sm" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
@endsection