@extends('admin::app')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                    @foreach ($roles as $role)

                    <a class="list-group-item list-group-item-action {{ $role->id == $active_role->id ? 'active':'' }}"
                        href="{{ route("admin.role-permission.index", [
                            'role' => $role->name,
                        ]) }}">
                        {{ $role->name }}
                    </a>

                    @endforeach

                    <!-- Button trigger modal -->
                    <button type="button" class="btn outline-0 boxshadow-0 list-group-item list-group-item-action"
                        data-toggle="modal" data-target="#createRoleModal">
                        <i class="fa fa-plus"></i>
                        @lang(' Add Role ')
                    </button>

                </div>
            </div>
            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="permissions-list" role="tabpanel">
                        <form action="{{ route('admin.role-permission.index', [
                            'role' => $active_role
                        ]) }}" method="POST">
                            @csrf
                            @method('put')

                            @php
                            $active_role_permissions = $active_role->permissions->pluck('id')->toArray();
                            @endphp

                            @foreach ($permissions as $permission)

                            @php
                            $permission_id = "permission_" . $permission->id;

                            $role_has_permission = in_array(
                            $permission->id,
                            $active_role_permissions
                            );
                            @endphp

                            <div class="input-group mb-3">

                                <input id="{{ $permission_id  }}" @if($role_has_permission) checked @endif
                                    name="permissions[]" type="checkbox" value="{{ $permission->id }}">

                                <label for="{{ $permission_id  }}" class="mb-0 mx-2">
                                    @lang($permission->name)
                                </label>
                            </div>

                            @endforeach

                            <button type="submit" class="btn btn-outline-success mt-4">@lang(' Save ')</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="createRoleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createRoleModalLabel"> @lang(' Add Role ')</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.role-permission.create-role') }}" method="post">
                            @csrf

                            <div class="input-group mb-3">
                                <input required min="3" name="name" type="name" class="form-control"
                                    value="{{ old('name') }}" placeholder="@lang(' Role Name ')">
                                <div class="input-group-append">
                                    <span class="fa fa-tasks input-group-text"></span>
                                </div>

                            </div>

                            @error('name')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <button type="submit" class="btn btn-success">@lang(' Save ')</button>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            @lang(' Cancel ')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection