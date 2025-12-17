<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = new Users();
        $result = $users->getAllUsers();
        $data = [
            'users' => $result
        ];
        return view('users', $data); 
    }
}