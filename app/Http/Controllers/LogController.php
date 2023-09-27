<?php

namespace App\Http\Controllers;

use App\Models\Log;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logs = Log::paginate(30);

        return view('logs.index')->with('logs', $logs);
    }

}
