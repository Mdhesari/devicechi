@extends('admin::app')

@push('add_styles')
<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" /> -->
<link rel="stylesheet" href="{{ asset('css/admin/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css') }}">
@endpush

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row tools">
            <div class="col-12">
                <form id="menu-form-toggle" method="get" action="{{ route('admin.menu-editor.show') }}">
                    <div class="row align-items-end">
                        <div class="col-12 col-lg-8 form-group">
                            <label>
                                @lang(' Groups ')
                            </label>
                            <select id="menu-group" name="group" class="form-control">
                                @foreach($groups as $group)
                                <option value="{{ $group->key }}" {{ $group->id === $menu->id ? "selected":"" }}>{{ $group->renderName() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 btn-group mb-3">
                            <!-- <button type="submit" class="btn btn-success">
                                <span class="fas fa-arrow-right"></span>
                                @lang(' Go to menu ')
                            </button> -->
                            <a href="{{ route("admin.menu-editor.store.group") }}" class="btn btn-outline-primary">
                                <span class="fas fa-plus"></span>
                                @lang(' Add new menu ')
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card border-primary mb-3">
                    <div class="card-header bg-primary text-white">@lang(' Edit item ')</div>
                    <div class="card-body">
                        <form id="frmEdit" class="form-horizontal">
                            <div class="form-group">
                                <label for="text">@lang(' Text ')</label>
                                <div class="input-group">
                                    <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                                    <div class="input-group-append">
                                        <button type="button" id="myEditor_icon" class="btn btn-outline-secondary"></button>
                                    </div>
                                </div>
                                <input type="hidden" name="icon" class="item-menu">
                            </div>
                            <div class="form-group">
                                <label for="href">@lang(' URL ')</label>
                                <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                            </div>
                            <div class="form-group">
                                <label for="target">Target</label>
                                <select name="target" id="target" class="form-control item-menu">
                                    <option value="_self">Self</option>
                                    <option value="_blank">Blank</option>
                                    <option value="_top">Top</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">@lang(' Tooltip ')</label>
                                <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i>
                            @lang(' Update ')
                        </button>
                        <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i>
                            @lang(' Add ')
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <ul id="myEditor" class="sortableLists list-group">
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form id="submit-menu" action="{{ route('admin.menu-editor.store', $menu) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="items" id="items-input">
                        <input type="hidden" name="group" id="items-input" value="{{ $menu->id }}">
                    </div>

                    <div class="btn-group btn-menu-save m-4">
                        <button type="submit" class="btn btn-success d-block mx-auto">
                            <i class="fas fa-save"></i>
                            @lang(' Save menu ')
                        </button>
                        <a href="{{ route('admin.menu-editor.delete.group', $menu) }}" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@push('add_scripts')
<script type="text/javascript" src="{{ asset('css/admin/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('css/admin/jquery-menu-editor.min.js') }}"></script>
<script>
    var items = @json($items);

    // icon picker options
    var iconPickerOptions = {
        searchText: "جستجو بین آیکون ها...",
        labelHeader: "{0}/{1}"
    };
    // sortable list options
    var sortableListOptions = {
        placeholderCss: {
            'background-color': "#cccccc"
        }
    };
    var editor = new MenuEditor('myEditor', {
        listOptions: sortableListOptions,
        iconPicker: iconPickerOptions,
        maxLevel: 2 // (Optional) Default is -1 (no level limit)
        // Valid levels are from [0, 1, 2, 3,...N]
    });
    editor.setForm($('#frmEdit'));
    editor.setUpdateButton($('#btnUpdate'));
    //Calling the update method
    $("#btnUpdate").click(function() {
        editor.update();
    });
    // Calling the add method
    $('#btnAdd').click(function() {
        editor.add();
    });

    $('#submit-menu').on('submit', function(e) {

        $("#items-input").val(editor.getString())
    });

    $('#menu-group').on('change', function(e) {

        $('#menu-form-toggle').submit();
    });

    editor.setData(items)

    // var str = editor.getString();
</script>
@endpush
