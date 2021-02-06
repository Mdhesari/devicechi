<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route("admin.dashboard") }}" class="brand-link">
        {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ $user->image }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route("admin.profile") }}" class="d-block">
                        {{ $user->name }}
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->

                    @foreach($sidebar_nav as $key => $item)

                    @isset($item['title'])

                    @if(isset($item['permission']) && $user->can($item['permission']))

                    <li class="nav-item" data-key="{{ $loop->index }}">
                        <a href="{{ route($item['route'], $item['route_params']) }}"
                            class="nav-link @route($item['route']) active @endroute">
                            <i class="{{ $item['icon_class'] }}"></i>
                            <p>
                                {{ $item['title'] }}
                            </p>
                        </a>
                    </li>

                    @endif

                    @else

                    @if(isset($item['permission']) && $user->can($item['permission']))

                    <?php $treeviewRoutes = collect($item)->pluck('route')->toArray(); ?>

                    <li class="nav-item has-treeview @route($treeviewRoutes) menu-open @endroute">

                        <a href="#" class="nav-link @route($treeviewRoutes) active @endroute">
                            <i
                                class="{{ isset($item['icon_class']) ? $item['icon_class'] : 'nav-icon fa fa-dashboard'}}"></i>
                            <p>
                                {{ $item['label'] }}
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">

                            @foreach ($item as $item_child)

                            @if(is_array($item_child))

                            @if(!isset($item_child['permission']) || $user->can($item_child['permission']))
                            <li class="nav-item" data-key="{{ $loop->index }}">
                                <a href="{{ route($item_child['route'], $item_child['route_params']) }}"
                                    class="nav-link @route($item_child['route']) active @endroute">
                                    <i class="{{ $item_child['icon_class'] }}"></i>
                                    <p>
                                        {{ $item_child['title'] }}
                                    </p>
                                </a>
                            </li>
                            @endif

                            @endif

                            @endforeach

                        </ul>
                    </li>

                    @endif

                    @endisset

                    @endforeach
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>