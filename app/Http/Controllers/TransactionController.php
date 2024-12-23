<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Consigne;
use App\Models\Job;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\Orders;
use App\Models\Cost;
use App\Models\Transaction_detail;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;

class TransactionController extends Controller
{
    function index()
    {
        $company = Company::all();
        $consigne = Consigne::all();
        $job = Job::all();
        $currentDate = date('y/m');
        $jobsWithDate = $job->map(function ($jobs) use ($currentDate) {
            $jobs->display_date = $currentDate;
            return $jobs;
        });
        $item = Item::all();
        $itemCost = Item::all();
        $cart = session('cart_items', []);
        $cost = session('cost_items', []);
        
        return view('transaction.index', compact('company', 'consigne', 'jobsWithDate', 'cart', 'cost', 'item', 'itemCost'));
    }

    function loadCart()
    {
        $items = session('cart_items', []);
        return response()->json($items);
    }

    function loadCost()
    {
        $costItem = session('cost_items', []);
        return response()->json($costItem);
    }

    function showCart()
    {
        $cart = session()->get('cart', []);

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('transaction.index', compact('cart', 'totalPrice'));
    }

    function showCost()
    {
        $cost = session()->get('cost', []);

        $totalCost = 0;
        foreach ($cost as $itemCost) {
            $totalCost += $itemCost['price'] * $itemCost['quantity'];
        }

        return view('transaction.index', compact('cost', 'totalCost'));
    }

    function addItem(Request $request)
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

    function addCost(Request $request)
    {
        $itemCost = [
            'item_id' => $request->item_id,
            'nama_item' => $request->nama_item,
            'qty' => 1,
            'satuan' => $request->satuan,
            'price' => $request->price,
        ];

        $cost = session('cost_items', []);
        
        $found = false;
        foreach ($cost as &$costItem) {
            if (isset($costItem['item_id']) && $costItem['item_id'] == $itemCost['item_id']) {
                $costItem['qty'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cost[] = $itemCost;
        }
        

        session(['cost_items' => $cost]);

        $totalCost = 0;
        foreach ($cost as $content) {
            $totalCost += $content['price'] * $content['qty'];
        }

        return response()->json([
            'msg' => 'Item added to cart',
            'status' => true,
            'totalCost' => number_format($totalCost, 0, ',', '.')
        ]);
    }

    function updateCart(Request $request)
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

    function updateCost(Request $request)
    {
        $itemId = $request->input('item_id');
        $qty = $request->input('qty');

        $cost = session('cost_items', []);

        foreach ($cost as &$costItem) {
            if ($costItem['item_id'] == $itemId) {
                $costItem['qty'] = $qty; 
                break;
            }
        }

        session(['cost_items' => $cost]);

        return response()->json(['status' => 'success', 'message' => 'Jumlah cost berhasil diperbarui']);
    }

    function deleteItem(Request $request)
    {
        $itemId = $request->input('item_id');
        $cart = session('cart_items', []);
        $cart = array_filter($cart, function ($cartItem) use ($itemId) {
            return $cartItem['item_id'] !== $itemId;
        });

        $cart = array_values($cart);

        session(['cart_items' => $cart]);
    }

    function deleteCost(Request $request)
    {
        $itemId = $request->input('item_id');
        $cost = session('cost_items', []);
        $cost = array_filter($cost, function ($costItem) use ($itemId) {
            return $costItem['item_id'] !== $itemId;
        });

        $cost = array_values($cost);

        session(['cost_items' => $cost]);
    }


    function store(Request $request)
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
            'name' => Auth::user()->name,
            'company_name' => $request->company,
            'transaction_id' => $transactionId,
            'status' => 1,
        ]);
        $transaction->save();

        // cart
        $cart = session('cart_items', []);
        if (empty($cart)) {
            Alert::toast('Your cart is empty. Please add items to the cart before proceeding.', 'error');
            return redirect()->back();
        }
        $cart = session('cart_items', []);
        foreach ($cart as $item) {
            $total = $item['price'] * $item['qty'];
        Transaction_detail::create([
                'transaction_id' => $transactionId,
                'nama_item' => $item['nama_item'],
                'amount' => $item['qty'],
                'price' => $item['price'],
                'tax' => $request->tax,
                'total_price' => $total,
            ]);
        }
        session()->forget('cart_items');

        // cost
        $cost = session('cost_items', []);
        if (empty($cost)) {
            Alert::toast('Your cost is empty. Please add items to the cart before proceeding.', 'error');
            return redirect()->back();
        }
        $cost = session('cost_items', []);
        foreach ($cost as $items) {
            $total = $items['price'] * $items['qty'];
        Cost::create([
                'transaction_id' => $transactionId,
                'nama_item' => $items['nama_item'],
                'amount' => $items['qty'],
                'price' => $items['price'],
                'total_cost' => $total,
                'gross_profit' => '8500',
                'pph' => '8500',
                'profit' => '8500',
            ]);
        }
        session()->forget('cost_items');

        $jobs = $request->job_no ?? 'AT';
        $latestOrder = Orders::latest('created_at')->first();
        
        // Generate prefix
        $prefix = !$latestOrder ? '0001' : 
        str_pad((int)substr($latestOrder->job_no, 0, 4) + 1, 4, '0', STR_PAD_LEFT);
        
        // Reset to 0001 if exceeds 9999
        if ((int)$prefix > 9999) {
            $prefix = '0001';
        }

        // Format job number with prefix and current year-month
        $jobNumber = $prefix . '/' . $request->job_no . '/' . date('ym');

        $request->validate([
            'job_ref' => 'required|string|max:255',
            'flight_date' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'mawb' => 'required|string|max:255',
            'shipper' => 'required|string|max:255',
        ]);

        Orders::create([
            'transaction_id' => $transactionId,
            'job_no' => $jobNumber,
            'job_ref' => $request->job_ref,
            'flight_date' => $request->flight_date,
            'destination' => $request->destination,
            'mawb' => $request->mawb,
            'hawb' => $request->hawb ?? '-',
            'consigne' => $request->consigne,
            'shipper' => $request->shipper,
            'detail' => $request->detail ?? '-',
        ]);
        alert()->success('Success', 'Transaction submitted successfully!');
        return redirect()->route('invoice.index');
    }
}
