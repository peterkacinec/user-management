@extends ('layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('user_management::role.Title')}}</div>
        <div class="card-body">
            <form method="post" action="{{route('roles.update', $role->id)}}">
                @csrf
                @method('put')
                @include('user_management::roles._form', [])
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-sm">{{__('user_management::general.Save')}}</button>
                    <a role="button" class="btn btn-secondary btn-sm" href="{{url()->previous()}}">{{__('user_management::general.Back')}}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
