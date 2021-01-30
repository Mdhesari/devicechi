<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @styles

    @stack('add_styles')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('admin::partials.navbar')

        @include('admin::partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @if($success = session('success'))
            <p class="alert alert-success">{{ $success }}</p>
            @endif

            @if($error = session('error'))
            <p class="alert alert-danger">{{ $error }}</p>
            @endif

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <x-breadcrumb-container :title="$page_title">
                        @yield('breadcrumb-item')
                    </x-breadcrumb-container>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('admin::partials.footer')

        @include('admin::partials.sidebar-control')
    </div>
    <!-- ./wrapper -->

    <!-- modal container (required if you need to render dynamic bootstrap modals) -->
    @include('leantony::modal.container')

    @scripts

    @stack('add_scripts')
    @stack('grid_js')

</body>

</html>