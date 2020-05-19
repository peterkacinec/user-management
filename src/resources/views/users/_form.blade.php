<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">{{__('user.Name')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('name') ? 'with_error' : '' }}" type="text" name="name" value="{{ old('name', $user->name ?? null) }}"/>
        @error('name')
            <div class="form_field_error">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="surname" class="col-sm-2 col-form-label">{{__('user.Surname')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('surname') ? 'with_error' : '' }}" type="text" name="surname" value="{{ old('surname', $user->surname ?? null) }}"/>
        @error('surname')
            <div class="form_field_error">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">{{__('user.Email')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('email') ? 'with_error' : '' }}" type="text" name="email" value="{{ old('email', $user->email ?? null) }}" required/>
        @error('email')
            <div class="form_field_error">{{ $message }}</div>
        @enderror
    </div>
</div>
@if($dontRequiredPassword)
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">{{__('user.Password')}}</label>
        <div class="col-sm-10">
            <input class="form-control" type="password" name="password"/>
            @foreach ($errors->get('password') as $message)
                <div class="form_field_error">{{ $message }}</div>
            @endforeach
        </div>
    </div>
    <div class="form-group row">
        <label for="password_confirmation" class="col-sm-2 col-form-label">{{__('user.Password confirmation')}}</label>
        <div class="col-sm-10">
            <input class="form-control" type="password" name="password_confirmation"/>
            @error('password_confirmation')
                <div class="form_field_error">{{ $message }}</div>
            @enderror
        </div>
    </div>
@else
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">{{__('user.Password')}}</label>
        <div class="col-sm-10">
            <input class="form-control" type="password" name="password" value="{{ old('password', $user->password ?? null) }}" required/>
            @foreach ($errors->get('password') as $message)
                <div class="form_field_error">{{ $message }}</div>
            @endforeach
        </div>
    </div>
    <div class="form-group row">
        <label for="password_confirmation" class="col-sm-2 col-form-label">{{__('user.Password confirmation')}}</label>
        <div class="col-sm-10">
            <input class="form-control" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" required/>
            @error('password_confirmation')
                <div class="form_field_error">{{ $message }}</div>
            @enderror
        </div>
    </div>
@endif
<div class="form-group row">
    <label for="roles" class="col-sm-2 col-form-label">Role</label>
    <div class="col-sm-10">
        <select multiple class="form-control" name="roles[]" id="roles">
            @foreach($user->roleList() as $role)
                <option value="{{ $role->id }}" @foreach($user->roles as $selectedRole) @if($selectedRole->id == $role->id)selected="selected"@endif @endforeach>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
</div>
