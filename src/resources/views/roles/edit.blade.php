@extends ('layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('user-management::role.Title')}}</div>
        <div class="card-body">
            <form method="post" action="{{route('roles.update', $role->id)}}">
                @csrf
                @method('put')
                @include('user-management::roles._form', [])
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-sm">{{__('user-management::general.Save')}}</button>
                    <a role="button" class="btn btn-secondary btn-sm" href="{{url()->previous()}}">{{__('user-management::general.Back')}}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
