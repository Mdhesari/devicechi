@inject('menuItemHelper', \App\Helpers\MenuItemHelper::class)

@if ($menuItemHelper->isSubmenu($item))

    {{-- Dropdown submenu --}}
    @include('admin::partials.navbar.dropdown-item-submenu')

@elseif ($menuItemHelper->isLink($item))

    {{-- Dropdown link --}}
    @include('admin::partials.navbar.dropdown-item-link')

@endif
