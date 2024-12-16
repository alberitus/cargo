<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Transaction_detail;
use App\Models\Company;


class ReportController extends Controller
{
    function index(){
        $transactions = Transaction::with('transactionDetails.item', 'company', 'user')->get();

        foreach ($transactions as $transaction) {
            $transaction->grand_total = $transaction->transactionDetails->sum('total_price');

            $transaction->total_tax = $transaction->transactionDetails->sum('tax');
        }
        
        return view('report.report', compact('transactions'));
    }
}
