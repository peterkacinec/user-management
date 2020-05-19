<?php

Route::get('role', function(){
    echo 'Hello from the calculator package!';
});

Route::get('hello/{a}', 'KornerBI\UserManagement\Controllers\UserManagementController@add');
Route::get('dovi/{a}', 'KornerBI\UserManagement\Controllers\UserManagementController@subtract');


//"KornerBI\\UserManagement\\": "packages/user_management/src"
