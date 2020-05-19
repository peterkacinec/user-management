<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">{{__('role.Name')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('name') ? 'with_error' : '' }}" type="text" name="name" id="name" value="{{ old('name', $role->name ?? null) }}"/>
        @error('name')
            <div class="form_field_error">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="slug" class="col-sm-2 col-form-label">{{__('role.Slug')}}</label>
    <div class="col-sm-10">
        <input class="form-control {{ $errors->has('slug') ? 'with_error' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $role->slug ?? null) }}"/>
        @error('slug')
            <div class="form_field_error">{{ $message }}</div>
        @enderror
    </div>
</div>
