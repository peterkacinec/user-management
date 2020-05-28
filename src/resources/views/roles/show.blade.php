@extends ('layouts.app')
@section ('content')
    <div class="form-group">
        <a role="button" class="btn btn-primary btn-sm" href="{{ route(config('user-management.route-name').'roles.edit', $role->id) }}">{{__('user-management::general.Edit')}}</a>
        <a href="javascript:;"
           data-toggle="modal"
           onclick="deleteData({{ route(config('user-management.route-name').'roles.destroy', $role->id) }})"
           data-target="#DeleteModal"
           class="btn btn-danger btn-sm"
        >{{__('user-management::general.Delete')}}</a>
    </div>
    <div class="card">
        <div class="card-header">{{__('user-management::role.Title')}}</div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">{{__('user-management::role.Name')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="name"  value="{{ $role->name }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="surname" class="col-sm-2 col-form-label">{{__('user-management::role.Slug')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="slug" value="{{ $role->slug }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="created_at" class="col-sm-2 col-form-label">{{__('user-management::general.Created at')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($role->created_at)->format('d.m.Y H:i:s') }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="updated_at" class="col-sm-2 col-form-label">{{__('user-management::general.Updated at')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($role->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
                </div>
            </div>
        </div>
    </div>
@endsection
