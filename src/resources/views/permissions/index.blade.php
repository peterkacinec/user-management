@php
    $columns = [
        [
            'label' => __('user-management::permission.Name'),
            'key' => 'name',
            'type' => 'text'
        ],
        [
            'label' => __('user-management::permission.Slug'),
            'key' => 'slug',
            'type' => 'text'
        ],
        [
            'label' => __('user-management::general.Created at'),
            'key' => 'created_at',
            'type' => 'date'
        ],
    ];

    $gridview = new \KornerBI\SimpleTable\SimpleTable($columns, $data, \KornerBI\UserManagement\Models\Permission::ENTITY_ROUTE_PREFIX);
@endphp
@extends ('layouts.app')
@section ('content')
    <div class="card">
        <div class="card-header">{{__('user-management::permission.Permission list')}}</div>
        <div class="card-body">
            <div class="form-group form-row">
                <a role="button" class="btn btn-primary btn-sm" href="{{ route(config('user-management.route-name-prefix').'permissions.create') }}">{{__('user-management::general.Create')}}</a>
            </div>
            <?= $gridview->render(); ?>
        </div>
    </div>
@endsection
