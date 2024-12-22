<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf;
use App\Models\Orders;
use App\Models\Transaction;
use App\Models\Transaction_detail;


class InvoiceController extends Controller
{
    function index()
    {
        $transaction = Transaction::with('transactionDetails', 'orders')->get();
        return view('invoice.index', compact('transaction'));
    }

    public function cetak($id)
    {
        $transaction = Transaction::with(['orders', 'transactionDetails'])
            ->where('transaction_id', $id)
            ->firstOrFail();
            
        return view('invoice.cetak', compact('transaction'));
    }

    public function export_pdf($id)
    {
        $transaction = Transaction::with(['orders', 'transactionDetails'])
            ->where('transaction_id', $id)
            ->firstOrFail();

        $html = View('invoice.pdf', compact('transaction'))->render();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
