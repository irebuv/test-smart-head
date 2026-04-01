<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class StatisticController extends Controller
{
    public function __invoke()
    {
        $day = Ticket::lastDay()->count();
        $week = Ticket::lastWeek()->count();
        $month = Ticket::lastMonth()->count();

        return response()->json([
            'day' => $day,
            'week' => $week,
            'month' => $month,
        ]);
    }
}
