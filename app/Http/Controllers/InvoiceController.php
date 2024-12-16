<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use App\Models\Company;
use App\Models\Job;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\Transaction_detail;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    function index()
    {
        $company = Company::all();
        $job = Job::all();
        $id = Auth::id();
        $currentDate = date('y/m');
        $jobsWithDate = $job->map(function ($jobs) use ($currentDate) {
            $jobs->display_date = $currentDate;
            return $jobs;
        });
        $item = Item::all();
        $cart = session('cart_items', []);
        
        return view('invoice.index', compact('company', 'jobsWithDate', 'id', 'cart', 'item'));
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


public function store(Request $request)
{
    $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

    $lastTransaction = Transaction::orderBy('transaction_id', 'desc')->first();
    $prefix = 'B';
    $lastNumber = 0;
    if ($lastTransaction) {
        $lastNumber = (int)substr($lastTransaction->transaction_id, 1);
    }

    $newNumber = $lastNumber + 1;

    $transactionId = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);

    while (Transaction::where('transaction_id', $transactionId)->exists()) {
        $newNumber++;
        $transactionId = $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
    }


    $transaction = Transaction::create([
        'id' => Auth::id(),
        'company_id' => $request->company_id,
        'transaction_id' => $transactionId, 
    ]);
    $transaction->save();

    $cart = session('cart_items', []);
    foreach ($cart as $item) {
        $total = $item['price'] * $item['qty'];
    Transaction_detail::create([
            'transaction_id' => $transactionId,
            'item_id' => $item['item_id'], // ID item dari cart
            'amount' => $item['qty'],      // Quantity dari cart
            'price' => $item['price'],
            'tax' => $request->tax,
            'total_price' => $total,
        ]);
    }

    return redirect()->back()->with('success', 'Transaction submitted successfully!');
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


// 'job_no' => $request->job_no. ' ' . date('y/m'),
        // 'job_ref' => $request->job_ref,
        // 'flightdate' => $request->flightdate,
        // 'destination' => $request->destination,
        // 'mawb' => $request->mawb,
        // 'hawb' => $request->hawb,
        // 'consigne' => $request->consigne,
        // 'shipper' => $request->shipper,
        // 'detail' => $request->detail ?? '-',