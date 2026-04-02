<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::query()->orderBy('created_at', 'desc')->get();

        return view('admin.users', compact('users'));
    }
}
