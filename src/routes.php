<?php

Route::group([
    'prefix' => config('user-management.route-prefix'),
    'middleware' => ['web', 'auth']
], function () {
    Route::resources([
        'users'         => 'KornerBI\UserManagement\Controllers\UserController',
        'roles'         => 'KornerBI\UserManagement\Controllers\RoleController',
        'permissions'   => 'KornerBI\UserManagement\Controllers\PermissionController'
    ]);
    Route::get('/users/{user}/editProfile', 'KornerBI\UserManagement\Controllers\UserController@editProfile')->name('users.editProfile');
    Route::put('/users/{user}/updateProfile', 'KornerBI\UserManagement\Controllers\UserController@updateProfile')->name('users.updateProfile');
});
