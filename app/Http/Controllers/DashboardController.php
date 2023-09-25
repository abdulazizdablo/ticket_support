<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Gate;


class DashboardController extends Controller
{
    public function index()
    {


        if (Gate::allows('manage-dashboard')) {

            $tickets_total_count = Ticket::count();
            $tickets_opened_count = Ticket::where('status_id', 1)->count();
            $tickets_closed_count = Ticket::where('status_id', 2)->count();

            return view('dashboard')->with('tickets_total_count',  $tickets_total_count)->with('tickets_opened_count', $tickets_opened_count)->with('tickets_closed_count', $tickets_closed_count);
        }

        else{

            return view('dashboard');
        }
    }
}
