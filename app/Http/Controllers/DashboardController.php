<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Transaction;
use App\Models\Transaction_detail;



class DashboardController extends Controller
{
    public function index()
    {
        $totalCompanies = Company::count();
        $totalTransaction = Transaction::count();
        $totalIncome = Transaction_detail::sum('total_price');
        $orderCount = Transaction::where('status', 1)->count();
        $transactions = Transaction::with('transactionDetails')
        ->latest('created_at')
        ->get();

        $dailyIncome = Transaction_detail::selectRaw('DATE(created_at) as date, SUM(total_price) as total_income')
        ->whereRaw('DATE(created_at) >= ?', [now()->subDays(7)])  // Ambil 7 hari terakhir
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $labels = $dailyIncome->pluck('date')->map(function($date) {
        return date('d M', strtotime($date));
    })->toArray();
    
    $data = $dailyIncome->pluck('total_income')->toArray();

    $startDate = $dailyIncome->first()->date ?? now();
    $endDate = $dailyIncome->last()->date ?? now();

        return view('index', compact('totalCompanies','transactions', 'orderCount', 'totalTransaction', 'totalIncome', 'labels', 'data', 'startDate', 'endDate'));
    }
}
