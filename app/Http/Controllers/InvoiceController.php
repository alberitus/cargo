<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf;
use App\Models\Transaction;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;



class InvoiceController extends Controller
{

    function index()
    {
        $transaction = Transaction::with('transactionDetails', 'orders')->get();
        return view('invoice.index', compact('transaction'));
    }

    public function cetak($encryptedId)
    {
        try {
            // Dekripsi ID
            $id = Crypt::decryptString($encryptedId);

            $transaction = Transaction::with(['orders', 'transactionDetails'])
                ->where('transaction_id', $id)
                ->firstOrFail();

            return view('invoice.cetak', compact('transaction'));
        } catch (\Exception $e) {
            abort(404, 'Invalid URL');
        }
    }

    public function updateStatus($encryptedId)
{
    try {
        $id = Crypt::decryptString($encryptedId);
        
        Transaction::where('transaction_id', $id)
            ->update(['status' => 2,
            'date_payment' => now(),]);

        return redirect()->back()->with('success', 'Invoice berhasil ditutup');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menutup invoice');
    }
}

    public function export_pdf($encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);

        $transaction = Transaction::with(['orders', 'transactionDetails'])
            ->where('transaction_id', $id)
            ->firstOrFail();

        $html = View('invoice.pdf', compact('transaction'))->render();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function destroy($transaction_id)
{
    $transaction = Transaction::with(['transactionDetails', 'orders'])->where('transaction_id', $transaction_id)->first();

    if ($transaction) {
        // Hapus semua data relasi menggunakan Eloquent
        $transaction->transactionDetails()->delete();
        $transaction->orders()->delete();

        // Hapus data utama
        $transaction->delete();
        
        Alert::success('Success', 'Invoice deleted successfully.');
        return redirect()->route('invoice.index');
    }
    Alert::error('Error', 'Invoice not found.');
    return redirect()->back();
}
}
