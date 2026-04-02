<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'number' => 'required|regex:/^\+[1-9]\d{7,14}$/',
            'email' => 'required|email',
            'theme' => 'required|string|min:5',
            'description' => 'nullable|string',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:png,jpeg,jpg,txt|max:2048',
        ], [
            'number.regex' => 'The number must be in E.164 format (e.g. +380501234567)'
        ]);

        try {
            DB::beginTransaction();

            $customer = Customer::updateOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => $validated['name'],
                    'number' => $validated['number'],
                ]
            );

            $ticket = Ticket::create([
                'customer_id' => $customer->id,
                'theme' => $validated['theme'],
                'description' => $validated['description'],
                'status' => 'new',
                'answered_at' => null,
            ]);

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $ticket->addMedia($file)->toMediaCollection('attachments');
                }
            }

            DB::commit();
            return response()->json([
                'message' => 'Your request has been sent successfully',
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something went wrong.',
            ], 500);
        }
    }
}
