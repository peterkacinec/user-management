@extends ('layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('user-management::user.New user')}}</div>
        <div class="card-body">
            <form method="post" action="{{route(config('user-management.route-name-prefix').'users.store')}}">
                @csrf
                @method('post')
                @include('user-management::users._form', ['dontRequiredPassword' => false])
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-sm">{{__('user-management::general.Save')}}</button>
                    <a role="button" class="btn btn-secondary btn-sm" href="{{url()->previous()}}">{{__('user-management::general.Back')}}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
