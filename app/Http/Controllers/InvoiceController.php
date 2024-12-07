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
        $cart = session('cart_items', []);
        
        return view('invoice.index', compact('company', 'cart', 'item'));
    }

    public function loadCart()
{
    // Ambil data keranjang dari session
    $items = session('cart_items', []);
    return response()->json($items);
}

public function showCart()
{
    // Ambil cart dari session
    $cart = session()->get('cart', []);

    // Hitung total harga
    $totalPrice = 0;
    foreach ($cart as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }

    // Kirim data cart dan total harga ke view
    return view('cart.index', compact('cart', 'totalPrice'));
}

public function addItem(Request $request)
{
    $item = [
        'item_id' => $request->item_id,
        'nama_item' => $request->nama_item,
        'qty' => 1,
        'satuan' => $request->satuan,
        'price' => $request->price,
    ];

    // Mendapatkan keranjang yang sudah ada di session
    $cart = session('cart_items', []);
    
    // Cek apakah item sudah ada di keranjang
    $found = false;
    foreach ($cart as &$cartItem) {
        if (isset($cartItem['item_id']) && $cartItem['item_id'] == $item['item_id']) {
            $cartItem['qty'] += 1;
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

    $totalPrice = 0;
    foreach ($cart as $contents) {
        $totalPrice += $contents['price'] * $contents['qty'];
    }

    return response()->json([
        'msg' => 'Item added to cart',
        'status' => true,
        'totalPrice' => number_format($totalPrice, 0, ',', '.') // Format total harga
    ]);
}

public function updateCart(Request $request)
{
    $itemId = $request->input('item_id');
    $qty = $request->input('qty');

    // Ambil keranjang dari session
    $cart = session('cart_items', []);

    // Cari item yang akan diperbarui qty-nya
    foreach ($cart as &$cartItem) {
        if ($cartItem['item_id'] == $itemId) {
            $cartItem['qty'] = $qty; // Update qty item
            break;
        }
    }

    // Simpan kembali keranjang yang sudah diubah ke session
    session(['cart_items' => $cart]);

    return response()->json(['status' => 'success', 'message' => 'Jumlah item berhasil diperbarui']);
}

public function deleteItem(Request $request)
{
    // Ambil item_id dari request
    $itemId = $request->input('item_id');

    // Ambil keranjang dari session
    $cart = session('cart_items', []);

    // Filter untuk menghapus item berdasarkan item_id
    $cart = array_filter($cart, function ($cartItem) use ($itemId) {
        return $cartItem['item_id'] !== $itemId;
    });

    // Reindex array setelah penghapusan
    $cart = array_values($cart);

    // Simpan kembali keranjang yang sudah diubah ke session
    session(['cart_items' => $cart]);

    // Mengirimkan response dengan pesan yang menyertakan item_id
    return response()->json(['status' => 'success', 'message' => "Item dengan ID {$itemId} berhasil dihapus"]);
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
