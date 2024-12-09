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
    $items = session('cart_items', []);
    return response()->json($items);
}

public function showCart()
{
    $cart = session()->get('cart', []);

    $totalPrice = 0;
    foreach ($cart as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }

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

    $cart = session('cart_items', []);
    
    $found = false;
    foreach ($cart as &$cartItem) {
        if (isset($cartItem['item_id']) && $cartItem['item_id'] == $item['item_id']) {
            $cartItem['qty'] += 1;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $cart[] = $item;
    }
    

    session(['cart_items' => $cart]);

    $totalPrice = 0;
    foreach ($cart as $contents) {
        $totalPrice += $contents['price'] * $contents['qty'];
    }

    return response()->json([
        'msg' => 'Item added to cart',
        'status' => true,
        'totalPrice' => number_format($totalPrice, 0, ',', '.')
    ]);
}

public function updateCart(Request $request)
{
    $itemId = $request->input('item_id');
    $qty = $request->input('qty');

    $cart = session('cart_items', []);

    foreach ($cart as &$cartItem) {
        if ($cartItem['item_id'] == $itemId) {
            $cartItem['qty'] = $qty; 
            break;
        }
    }

    session(['cart_items' => $cart]);

    return response()->json(['status' => 'success', 'message' => 'Jumlah item berhasil diperbarui']);
}

public function deleteItem(Request $request)
{
    $itemId = $request->input('item_id');

    $cart = session('cart_items', []);

    $cart = array_filter($cart, function ($cartItem) use ($itemId) {
        return $cartItem['item_id'] !== $itemId;
    });

    $cart = array_values($cart);

    session(['cart_items' => $cart]);

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
