<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;


class ReportController extends Controller
{
    function index(){

    }

    function company(){
        $transactions = Transaction::with( 'company', 'user')->get();

        foreach ($transactions as $transaction) {
            $transaction->grand_total = $transaction->transactionDetails->sum('total_price');
            $transaction->total_tax = $transaction->transactionDetails->sum('tax');
        }
        
        return view('report.report', compact('transactions'));
    }

    function item(){
        $transaction = Transaction::with('transactionDetails.item', 'user')->get();


        foreach ($transaction as $trans) {
            $trans->total_price = $trans->transactionDetails->sum('total_price');
            $trans->total_tax = $trans->transactionDetails->sum('tax');
            $trans->grand_total = $trans->total_price + $trans->total_tax;
        }

        return view('report.invoice', compact('transaction'));
    }

    function show()
    {

    }

    function list()
    {

    }

    function report()
    {

    }
}
