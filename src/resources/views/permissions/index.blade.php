@php
    $columns = [
        [
            'label' => __('user_management::permission.Name'),
            'key' => 'name',
            'type' => 'text',
            'settings' => [
                'searchable' => true,
                'placeholder' => __('table-component.settings.placeholder')
            ]
        ],
        [
            'label' => __('user_management::permission.Slug'),
            'key' => 'slug',
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
                'link' => '/admin/roles/',
                'attribute' => 'id',
            ],
            'condition' => true
        ]
    ];
@endphp
@extends ('layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('user_management::permission.Permission list')}}</div>
        <div class="card-body">
            <a role="button" class="btn btn-primary btn-sm" href="{{ route('permissions.create') }}">{{__('user_management::general.Create')}}</a>
            <table-component config="{{ json_encode($result) }}"></table-component>
        </div>
    </div>
@endsection
