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

        $dailyIncome = Transaction_detail::selectRaw('DATE(created_at) as date, SUM(total_price) as total_income')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $labels = $dailyIncome->pluck('date')->toArray();
    $data = $dailyIncome->pluck('total_income')->toArray();

    $startDate = $dailyIncome->first()->date ?? 'N/A';
        $endDate = $dailyIncome->last()->date ?? 'N/A';

        return view('index', compact('totalCompanies', 'totalTransaction', 'totalIncome', 'labels', 'data', 'startDate', 'endDate'));
    }
}
