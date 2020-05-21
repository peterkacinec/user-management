@extends ('layouts.app')
@section ('content')
    <div class="form-group">
        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <a role="button" class="btn btn-primary btn-sm" href="{{ route('permissions.edit', $permission->id) }}">{{__('user_management::general.Edit')}}</a>
            <button type="submit" class="btn btn-danger btn-sm">{{__('user_management::general.Delete')}}</button>
        </form>
    </div>
    <div class="card">
        <div class="card-header">{{__('user_management::role.Title')}}</div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">{{__('user_management::role.Name')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="name"  value="{{ $permission->name }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="surname" class="col-sm-2 col-form-label">{{__('user_management::role.Slug')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="slug" value="{{ $permission->slug }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="created_at" class="col-sm-2 col-form-label">{{__('user_management::general.Created at')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($permission->created_at)->format('d.m.Y H:i:s') }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="updated_at" class="col-sm-2 col-form-label">{{__('user_management::general.Updated at')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($permission->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
                </div>
            </div>
        </div>
    </div>
@endsection
