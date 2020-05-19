<?php

namespace KornerBI\UserManagement\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserManagementController extends Controller
{
    public function add($a){
        $result = 'Ahoj '. $a;
        return view('user_management::app', compact('result'));
    }

    public function subtract($a){
        $result = 'Dovidenia '. $a;
        return view('user_management::app', compact('result'));
    }
}
