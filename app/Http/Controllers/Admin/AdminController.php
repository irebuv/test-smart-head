<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $query = Ticket::query()->select('tickets.*')
            ->join('customers', 'customers.id', '=', 'tickets.customer_id');

        $sorts = [
            'id' => 'tickets.id',
            'status' => 'status',
            'created' => 'tickets.created_at',
            'email' => 'customers.email',
            'number' => 'customers.number',
        ];

        $sort = request('sort', 'id');
        $direction = request('direction', 'desc');

        $sortColumn = $sorts[$sort] ?? 'tickets.id';

        $tickets = $query->with('customer')->orderBy($sortColumn, $direction)->get();

        return view('admin.admin', compact('tickets', 'sort', 'direction'));
    }
}
