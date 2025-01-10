<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Transaction_detail;



class ReportController extends Controller
{
    function index(){

    }

    // Controller
public function company()
{
    $transactions = Transaction::select('transaction_id', 'name', 'company_name', 'status', 'stsfaktur', 'faktur')
        ->get()
        ->groupBy('company_name');
    
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

    public function tax(Request $request)
{
    $query = Transaction::with('transactionDetails.item', 'company', 'user');
    
    // Apply tax filter
    if ($request->has('filter')) {
        switch ($request->filter) {
            case '1.1':
                $query->whereHas('transactionDetails', function($q) {
                    $q->whereRaw('ABS(tax - ?) < 0.0001', [1.1]); // Menggunakan pembulatan untuk perbandingan
                });
                break;
            case '11':
                $query->whereHas('transactionDetails', function($q) {
                    $q->where('tax', 11);
                });
                break;
            case 'no':
                $query->whereHas('transactionDetails', function($q) {
                    $q->where('tax', 0)->orWhereNull('tax');
                });
                break;
        }
    }
    
    $transaction = $query->get();

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

    function outstanding()
    {
        $transactions = Transaction::with('transactionDetails', 'orders')
            ->select('transaction_id', 'name', 'company_name', 'status', 'created_at', 'date_payment')
            ->get()
            ->groupBy('company_name');

        foreach ($transactions as $companyName => $groupedTransactions) {
            foreach ($groupedTransactions as $transaction) {
                $transaction->total_price = $transaction->transactionDetails->sum('total_price');
                $transaction->total_tax = $transaction->transactionDetails->sum('tax');
                $transaction->grand_total = $transaction->total_price + $transaction->total_tax;
            }
        }

        return view('report.outstanding', compact('transactions'));
    }

    public function outstandingCust(Request $request)
{
    $allCompanies = Transaction::select('company_name')
        ->distinct()
        ->orderBy('company_name')
        ->pluck('company_name');

    $query = Transaction::with('transactionDetails', 'orders')
        ->select('transaction_id', 'name', 'company_name', 'status', 'created_at', 'date_payment');

    // Filter berdasarkan company_name jika ada
    if ($request->has('company_name') && $request->company_name != 'all') {
        $query->where('company_name', $request->company_name);
    }

    // Ambil data
    $transactions = $query->get()->groupBy('company_name');

    // Hitung total
    foreach ($transactions as $companyName => $groupedTransactions) {
        foreach ($groupedTransactions as $transaction) {
            $transaction->total_price = $transaction->transactionDetails->sum('total_price');
            $transaction->total_tax = $transaction->transactionDetails->sum('tax');
            $transaction->grand_total = $transaction->total_price + $transaction->total_tax;
        }
    }

    return view('report.outstanding-customer', compact('transactions', 'allCompanies'));
}
    function detailinv(){
        $transaction = Transaction::with('transactionDetails', 'orders')->where('status', 2)->get();

        foreach ($transaction as $detail) {
            $detail->total_price = $detail->transactionDetails->sum('total_price');
            $detail->total_tax = $detail->transactionDetails->sum('tax');
            $detail->grand_total = $detail->total_price + $detail->total_tax;
        }

        return view('report.detailinv', compact('transaction'));
    }

    function detailinvcus(){
        $transaction = Transaction::with('transactionDetails', 'orders')->where('status', 2)->get();

        foreach ($transaction as $detail) {
            $detail->total_price = $detail->transactionDetails->sum('total_price');
            $detail->total_tax = $detail->transactionDetails->sum('tax');
            $detail->grand_total = $detail->total_price + $detail->total_tax;
        }

        return view('report.detailinvcus', compact('transaction'));
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
