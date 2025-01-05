<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf;
use App\Models\Transaction;
use Illuminate\Support\Facades\Crypt;



class ExportController extends Controller
{
    public function exportCompany()
    {
        $transactions = Transaction::select('transaction_id', 'name', 'company_name', 'status', 'stsfaktur', 'faktur')
            ->get()
            ->groupBy('company_name');

        $html = View('export.customer', compact('transactions'))->render();
        
        $mpdf = new Mpdf([
            'orientation' => 'P',
            'format' => 'A4',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10
        ]);
        
        $mpdf->WriteHTML($html);
        $mpdf->Output('Company-Report.pdf', 'I');
    }

    public function exportCustOutsanding()
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

        $html = View('export.outstandingcust', compact('transactions'))->render();
        
        $mpdf = new Mpdf([
            'orientation' => 'L', // Landscape orientation
            'format' => 'A4',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 15,
            'margin_bottom' => 15
        ]);
        
        $mpdf->WriteHTML($html);
        $mpdf->Output('Outstanding-Invoice-Report.pdf', 'I');
    }

    public function exportTax(Request $request)
    {
        // Get filtered data using the same logic as the index method
        $query = Transaction::with('transactionDetails.item', 'company', 'user');
        
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

        // Calculate totals
        foreach ($transaction as $ord) {
            $ord->total_tax = $ord->transactionDetails->sum('tax');
        }

        // Initialize mPDF
        $mpdf = new Mpdf([
            'margin_left' => 20,
            'margin_right' => 20,
            'margin_top' => 20,
            'margin_bottom' => 20,
        ]);

        // Generate PDF content
        $html = view('export.tax', compact('transaction'))->render();

        // Set document title based on filter
        $title = 'Tax Report';
        if ($request->filter == '1.1') {
            $title .= ' - Tax 1.1%';
        } elseif ($request->filter == '11') {
            $title .= ' - Tax 11%';
        } elseif ($request->filter == 'no') {
            $title .= ' - No Tax';
        }

        $mpdf->SetTitle($title);
        $mpdf->WriteHTML($html);

        $filename = match ($request->filter) {
            '1.1' => 'Tax-Invoice-Report-1.1%.pdf',
            '11' => 'Tax-Invoice-Report-11%.pdf',
            'no' => 'Invoice-Without-Tax-Report.pdf',
            default => 'Tax-Invoice-Report-All.pdf',
        };
    
        // Output PDF with dynamic filename
        $mpdf->Output($filename, 'I');
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
}
