<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        

        $tickets = Ticket::query()->with('customer')->orderBy('created_at', 'desc')->get();

        return view('admin.admin', compact('tickets'));
    }
}
