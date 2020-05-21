@php
    $columns = [
        [
            'label' => __('user_management::user.Name'),
            'key' => 'name',
            'type' => 'text',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('table-component.settings.placeholder')
            ]
        ],
        [
            'label' => __('user_management::user.Surname'),
            'key' => 'surname',
            'type' => 'text',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('table-component.settings.placeholder')
            ]
        ],
        [
            'label' => __('user_management::user.Email'),
            'key' => 'email',
            'type' => 'text',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('table-component.settings.placeholder')
            ]
        ],
        [
            'label' => __('user_management::user.Roles'),
            'key' => 'roles',
            'type' => 'text',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('table-component.settings.placeholder')
            ]
        ],
        [
            'label' => __('general.Created at'),
            'key' => 'created_at',
            'type' => 'date',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('table-component.settings.placeholder')
            ]
        ],
    ];

    $result['columns'] = $columns;
    $result['actions'] = [
        [
            'label' => __('general.Detail'),
            'key' => 'detail',
            'class' => 'btn btn-primary btn-sm',
            'action' => null,
            'url' => [
                'link' => '/admin/users/',
                'attribute' => 'id',
            ],
            'condition' => true
        ]
    ];
@endphp
@extends ('layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('user_management::user.User list')}}</div>
        <div class="card-body">
            <a role="button" class="btn btn-primary btn-sm" href="{{ route('users.create') }}">{{__('general.Create')}}</a>
            <simple-table-component config="{{ json_encode($result) }}"></simple-table-component>
        </div>
    </div>
@endsection
