@php
    $entityRoutePrefix = '/users/';

    $columns = [
        [
            'label' => __('user_management::user.Name'),
            'key' => 'name',
            'type' => 'text'
        ],
        [
            'label' => __('user_management::user.Surname'),
            'key' => 'surname',
            'type' => 'text',
        ],
        [
            'label' => __('user_management::user.Email'),
            'key' => 'email',
            'type' => 'text'
        ],
        [
            'label' => __('user_management::general.Created at'),
            'key' => 'created_at',
            'type' => 'date'
        ],
    ];

    $gridview = new \KornerBI\UserManagement\SimpleTable($columns, $data, $entityRoutePrefix);
@endphp
@extends ('layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('user_management::user.User list')}}</div>
        <div class="card-body">
            <div class="form-group form-row">
                <a role="button" class="btn btn-primary btn-sm" href="{{ route('users.create') }}">{{__('user_management::general.Create')}}</a>
            </div>
            <?= $gridview->render(); ?>
        </div>
    </div>
@endsection
