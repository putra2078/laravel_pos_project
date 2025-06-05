<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    $userCount = User::count();

    $transactionCount = Transaction::whereDate('created_at', Carbon::today())->count();

    $today = now()->startOfDay();
    $omzetToday = Transaction::whereDate('created_at', $today)->sum('total');
    $profitToday = $omzetToday - Transaction::whereDate('created_at', $today)->sum('discount');

    return view('home', compact('transactionCount', 'omzetToday', 'profitToday', 'userCount'));
    }                                      
}
