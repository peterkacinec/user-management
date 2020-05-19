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

    <div class="card">
        <div class="card-header">{{__('user.Title')}}</div>
        <div class="card-body">
            <form method="post" action="{{route('admin.users.updateProfile', $user->id)}}">
                @csrf
                @method('put')

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">{{__('user.Email')}}</label>
                    <div class="col-sm-10">
                        <input class="form-control {{ $errors->has('email') ? 'with_error' : '' }}" type="text" name="email" id="email" value="{{ $user->email }}" disabled/>
                        @error('email')
                            <div class="form_field_error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">{{__('user.Name')}}</label>
                    <div class="col-sm-10">
                        <input class="form-control {{ $errors->has('name') ? 'with_error' : '' }}" type="text" name="name" id="name" value="{{ $user->name }}" />
                        @error('name')
                            <div class="form_field_error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="surname" class="col-sm-2 col-form-label">{{__('user.Surname')}}</label>
                    <div class="col-sm-10">
                        <input class="form-control {{ $errors->has('surname') ? 'with_error' : '' }}" type="text" name="surname" id="surname" value="{{ $user->surname }}" />
                        @error('surname')
                            <div class="form_field_error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">{{__('user.Password')}}</label>
                    <div class="col-sm-10">
                        <input class="form-control {{ $errors->has('password') ? 'with_error' : '' }}" type="password" name="password" id="password"/>
                        @foreach ($errors->get('password') as $message)
                            <div class="form_field_error">{{ $message }}</div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-2 col-form-label">{{__('user.Password confirmation')}}</label>
                    <div class="col-sm-10">
                        <input class="form-control {{ $errors->has('password_confirmation') ? 'with_error' : '' }}" type="password" name="password_confirmation" id="password_confirmation"/>
                        @error('password_confirmation')
                            <div class="form_field_error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-success btn-sm">{{__('general.Save')}}</button>
                    <a role="button" class="btn btn-secondary btn-sm" href="{{url()->previous()}}">{{__('general.Back')}}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
