<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use App\Models\Company;
use App\Models\Item;

class InvoiceController extends Controller
{
    function index()
    {
        $company = Company::all();
        $item = Item::all();
        return view('invoice.index', compact('company', 'item'));
    }

    public function loadCart()
    {
        $items = session('cart_items', []);
        return response()->json($items);
    }

    public function addItem(Request $request)
    {
        // Validasi input
        // $validated = $request->validate([
        //     'id' => 'required|integer',
        //     'nama_item' => 'required|string',
        //     'quantity' => 'required|integer|min:1',
        //     'satuan' => 'required|string',
        // ]);
    
        // Membuat array item untuk ditambahkan ke session
        $item = [
            'id' => $request->id,
            'nama_item' => $request->nama_item,
            'quantity' => $request->quantity,
            'satuan' => $request->satuan,
            // 'subtotal' => $request->quantity * 100,
        ];
    
        // Mendapatkan keranjang yang sudah ada di session
        $cart = session('cart_items', []);
        
        // Cek apakah item sudah ada di keranjang
        $found = false;
        foreach ($cart as &$cartItem) {
            if ($cartItem['id'] == $item['id']) {
                $cartItem['quantity'] += $item['quantity'];  // Update quantity jika item sudah ada
                // $cartItem['subtotal'] = $cartItem['quantity'] * 100; 
                $found = true;
                break;
            }
        }
    
        // Jika item belum ada, tambahkan item baru
        if (!$found) {
            $cart[] = $item;
        }
    
        // Simpan keranjang ke session
        session(['cart_items' => $cart]);
    
        return response()->json(['msg' => 'Item added to cart', 'status' => true]);
    }
    

    function list()
    {
        return view('invoice.list');
    }

    function report()
    {
        return view('invoice.report');
    }

    function export_pdf()
    {
        // $mpdf = new Mpdf();
        // $mpdf->WriteHTML(view('invoice.PDF'));
        // $mpdf->Output('invoice.pdf','D');
        // $mpdf->Output();  

        // Ambil HTML dari view
        $html = View('invoice.pdf')->render();

        // Inisialisasi MPDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
