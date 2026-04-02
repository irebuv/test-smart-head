<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
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

        return view('admin.tickets.tickets', compact('tickets', 'sort', 'direction'));
    }

    public function show(Ticket $ticket)
    {
        $mediaItems = $ticket->getMedia("attachments");

        return view('admin.tickets.show', compact('ticket', 'mediaItems'));
    }

    public function status(Ticket $ticket, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,in_process,closed',
        ]);

        $ticket->update([
            'status' => $validated['status'],
            'answered_at' => $ticket->answered_at ?? ($validated['status'] !== 'new' ? now() : null),
        ]);

        return redirect()->back();
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->back();
    }
}
