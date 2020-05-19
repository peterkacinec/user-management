@php
    $columns = [
        [
            'label' => __('user.Name'),
            'key' => 'name',
            'type' => 'text',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('table-component.settings.placeholder')
            ]
        ],
        [
            'label' => __('user.Surname'),
            'key' => 'surname',
            'type' => 'text',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('table-component.settings.placeholder')
            ]
        ],
        [
            'label' => __('user.Email'),
            'key' => 'email',
            'type' => 'text',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('table-component.settings.placeholder')
            ]
        ],
        [
            'label' => __('user.Roles'),
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
@extends ('layouts.app')
@section ('content')
    <flash-message-component config="{{ json_encode($config) }}"></flash-message-component>

    <div class="card">
        <div class="card-header">{{__('user.User list')}}</div>
        <div class="card-body">
            <a role="button" class="btn btn-primary btn-sm" href="{{ route('admin.users.create') }}">{{__('general.Create')}}</a>
            <table-component config="{{ json_encode($result) }}"></table-component>
        </div>
    </div>
@endsection
