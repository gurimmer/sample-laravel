<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class TopController extends Controller
{
    public function index()
    {
        Log::info('top index');
        return redirect()->route('todos.index');
    }
}
