@extends ('layouts.app')
@section ('content')
    @php
        $actionDelete =[
            'url' => url(config('simple-table.route-prefix').\KornerBI\UserManagement\Models\Permission::ENTITY_ROUTE_PREFIX.$permission->id),
            'modalText' => __('simple-table::modal.Confirmation delete')
        ];
    @endphp
    <div class="form-group">
        <a role="button" class="btn btn-primary btn-sm" href="{{ route(config('user-management.route-name-prefix').'permissions.edit', $permission->id) }}">{{__('user-management::general.Edit')}}</a>
        <a
            role="button"
            href="#"
            class = "btn btn-sm btn-danger"
            data-toggle="modal"
            data-target="#modalConfirm"
        >{{ __('user-management::general.Delete') }}</a>
        <modal-component
                :config="{{ json_encode($actionDelete) }}">
        </modal-component>
    </div>
    <div class="card">
        <div class="card-header">{{__('user-management::role.Title')}}</div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">{{__('user-management::role.Name')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="name"  value="{{ $permission->name }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="surname" class="col-sm-2 col-form-label">{{__('user-management::role.Slug')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="slug" value="{{ $permission->slug }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="created_at" class="col-sm-2 col-form-label">{{__('user-management::general.Created at')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($permission->created_at)->format('d.m.Y H:i:s') }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="updated_at" class="col-sm-2 col-form-label">{{__('user-management::general.Updated at')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($permission->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
                </div>
            </div>
        </div>
    </div>
@endsection
