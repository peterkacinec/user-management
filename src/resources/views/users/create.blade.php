@extends ('layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('user_management::user.New user')}}</div>
        <div class="card-body">
            <form method="post" action="{{route('users.store')}}">
                @csrf
                @method('post')
                @include('user_management::users._form', ['dontRequiredPassword' => false])
                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-sm">{{__('user_management::general.Save')}}</button>
                    <a role="button" class="btn btn-secondary btn-sm" href="{{url()->previous()}}">{{__('user_management::general.Back')}}</a>
                </div>
            </form>
        </div>
        <simple-table-component></simple-table-component>
    </div>
@endsection
