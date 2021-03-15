@inject('menuItemHelper', \App\Helpers\MenuItemHelper::class)

@if ($menuItemHelper->isSearchBar($item))

    {{-- Search form --}}
    @include('admin::partials.navbar.menu-item-search-form')

@elseif ($menuItemHelper->isSubmenu($item))

    {{-- Dropdown menu --}}
    @include('admin::partials.navbar.menu-item-dropdown-menu')

@elseif ($menuItemHelper->isLink($item))

    {{-- Link --}}
    @include('admin::partials.navbar.menu-item-link')

@endif
