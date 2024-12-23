<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Orders;


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
    function tax(){
        $transaction = Transaction::with('transactionDetails.item','company', 'user')->get();

        foreach ($transaction as $ord) {
        $ord->total_tax = $ord->transactionDetails->sum('tax');
        }

        return view('report.tax', compact('transaction'));
    }
    function payment(){
        $transaction = Transaction::where('status', 2)
        ->with('transactionDetails', 'orders')
        ->get();

        foreach ($transaction as $pay) {
            $pay->total_price = $pay->transactionDetails->sum('total_price');
            $pay->total_tax = $pay->transactionDetails->sum('tax');
            $pay->grand_total = $pay->total_price + $pay->total_tax;
        }

        return view('report.payment', compact('transaction'));
    }

    function outstanding(){
        $transaction = Transaction::with('transactionDetails', 'orders')->get();

        foreach ($transaction as $outs) {
            $outs->total_price = $outs->transactionDetails->sum('total_price');
            $outs->total_tax = $outs->transactionDetails->sum('tax');
            $outs->grand_total = $outs->total_price + $outs->total_tax;
        }

        return view('report.outstanding', compact('transaction'));
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
