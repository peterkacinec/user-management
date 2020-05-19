@extends ('layouts.app')
@section ('content')
    @php
        $config = [];

        if(Session::has('fail')){
            $config['message'] = Session::get('fail');
            $config['type'] = 'error';
            $config['timer'] = null;
        } elseif(Session::has('success')){
            $config['message'] = Session::get('success');
            $config['type'] = 'success';
            $config['timer'] = 4000;
        }
    @endphp
    <flash-message-component config="{{ json_encode($config) }}"></flash-message-component>

    <div class="form-group">
        <a role="button" class="btn btn-primary btn-sm" href="{{ route('admin.roles.edit', $role->id) }}">{{__('general.Edit')}}</a>
        <a href="javascript:;"
           data-toggle="modal"
{{--           onclick="deleteData({{ route('admin.roles.destroy', $role->id) }})"--}}
           data-target="#DeleteModal"
           class="btn btn-danger btn-sm"
        >{{__('general.Delete')}}</a>
    </div>
    <div class="card">
        <div class="card-header">{{__('role.Title')}}</div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">{{__('role.Name')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="name"  value="{{ $role->name }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="surname" class="col-sm-2 col-form-label">{{__('role.Slug')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="slug" value="{{ $role->slug }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="created_at" class="col-sm-2 col-form-label">{{__('general.Created at')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="created_at" value="{{ \Carbon\Carbon::parse($role->created_at)->format('d.m.Y H:i:s') }}" disabled/>
                </div>
            </div>
            <div class="form-group row">
                <label for="updated_at" class="col-sm-2 col-form-label">{{__('general.Updated at')}}</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="updated_at" value="{{ \Carbon\Carbon::parse($role->updated_at)->format('d.m.Y H:i:s') }}" disabled/>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('modal-confirm')
