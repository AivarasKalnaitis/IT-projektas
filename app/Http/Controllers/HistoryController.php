<?php

namespace App\Http\Controllers;

use App\InsuranceHistory;
use App\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        return view('history.index', [
            'users' => User::all(),
        ]);
    }

    public function show($userId)
    {
        $history = InsuranceHistory::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        return view('history.show', [
            'history' => $history,
            'user' => User::find($userId),
        ]);
    }
}
