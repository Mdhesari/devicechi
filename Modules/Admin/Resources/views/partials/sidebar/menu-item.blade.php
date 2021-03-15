@inject('menuItemHelper', \App\Helpers\MenuItemHelper::class)

@if ($menuItemHelper->isHeader($item))

{{-- Header --}}
@include('admin::partials.sidebar.menu-item-header')

@elseif ($menuItemHelper->isSearchBar($item))

{{-- Search form --}}
@include('admin::partials.sidebar.menu-item-search-form')

@elseif ($menuItemHelper->isSubmenu($item))

{{-- Treeview menu --}}
@include('admin::partials.sidebar.menu-item-treeview-menu')

@elseif ($menuItemHelper->isLink($item))

{{-- Link --}}
@include('admin::partials.sidebar.menu-item-link')

@endif
