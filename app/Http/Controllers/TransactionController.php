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

class TransactionController extends Controller
{
    // public function index()
    // {
    //     $company = Company::all();
    //     $consigne = Consigne::all();
    //     $job = Job::all();

    //     $jobsWithDate = $job->map(function ($jobs) {
    //         $latestOrder = Orders::where('job_no', 'LIKE', '%-' . $jobs->job_code . '/%')
    //             ->whereYear('created_at', now()->year)
    //             ->whereMonth('created_at', now()->month)
    //             ->latest('created_at')
    //             ->first();


    //         if ($latestOrder) {
    //             $currentPrefix = (int) substr($latestOrder->job_no, 0, strpos($latestOrder->job_no, '/'));
    //             $nextPrefix = str_pad($currentPrefix + 1, 4, '0', STR_PAD_LEFT);
    //         } else {
    //             $nextPrefix = '0001';
    //         }

    //         if ((int)$nextPrefix > 9999) {
    //             $nextPrefix = '0001';
    //         }

    //         $jobs->next_prefix = $nextPrefix;
    //         // dd($latestOrder);
    //         return $jobs;
    //     });

    //     $item = Item::all();
    //     $itemCost = Item::all();
    //     $cart = session('cart_items', []);
    //     $cost = session('cost_items', []);

    //     return view('transaction.index', compact('company', 'consigne', 'jobsWithDate', 'cart', 'cost', 'item', 'itemCost'));
    // }

    public function indexw()
    {
        $company = Company::all();
        $consigne = Consigne::all();
        $job = Job::all();

        $jobsWithDate = $job->map(function ($jobs) {
            $latestOrder = Orders::where('job_no', 'LIKE', 'AT/' . $jobs->job_code . '/%')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->latest('created_at')
                ->first();


            if ($latestOrder) {
                $currentPrefix = (int) substr($latestOrder->job_no, 0, strpos($latestOrder->job_no, '/'));
                $nextPrefix = str_pad($currentPrefix + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $nextPrefix = '0001';
            }

            if ((int)$nextPrefix > 9999) {
                $nextPrefix = '0001';
            }

            $jobs->next_prefix = $nextPrefix;
            // dd($latestOrder);
            return $jobs;
        });

        $item = Item::all();
        $itemCost = Item::all();
        $cart = session('cart_items', []);
        $cost = session('cost_items', []);

        return view('transaction.index', compact('company', 'consigne', 'jobsWithDate', 'cart', 'cost', 'item', 'itemCost'));
    }

    public function index()
    {
        $company = Company::all();
        $consigne = Consigne::all();
        $job = Job::all();

        // Format untuk prefix bulan dan tahun (YYMM)
        $currentYearMonth = now()->format('ym'); // Akan menghasilkan format '2412' untuk December 2024

        // Mencari job number terakhir dengan format AT/YYMM/*
        $latestOrder = Orders::where('job_no', 'LIKE', 'AT/' . $currentYearMonth . '/%')
            ->latest('created_at')
            ->first();

        // Menentukan prefix berikutnya
        if ($latestOrder) {
            $currentNumber = (int) substr($latestOrder->job_no, -4); // Mengambil 4 digit terakhir
            $nextNumber = $currentNumber + 1;

            // Reset ke 0001 jika melebihi 9999
            if ($nextNumber > 9999) {
                $nextNumber = 1;
            }

            $nextPrefix = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        } else {
            $nextPrefix = '0001';
        }

        // Format job number lengkap
        $nextJobNumber = 'AT/' . $currentYearMonth . '/' . $nextPrefix;

        $item = Item::all();
        $itemCost = Item::all();
        $cart = session('cart_items', []);
        $cost = session('cost_items', []);

        return view('transaction.index', compact(
            'company',
            'consigne',
            'job',
            'nextJobNumber',
            'cart',
            'cost',
            'item',
            'itemCost'
        ));
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

        $prefix = $request->stsfaktur == 1 ? 'B' : 'A';
        $year = date('y');
        $lastTransaction = Transaction::where('transaction_id', 'LIKE', $prefix . $year . '%')
            ->orderBy('transaction_id', 'desc')
            ->first();

        if ($lastTransaction) {
            $lastSequence = (int)substr($lastTransaction->transaction_id, -5);
            $newSequence = $lastSequence + 1;
        } else {
            $newSequence = 1;
        }
        $transactionId = $prefix . $year . str_pad($newSequence, 5, '0', STR_PAD_LEFT);
        while (Transaction::where('transaction_id', $transactionId)->exists()) {
            $newSequence++;
            $transactionId = $prefix . $year . str_pad($newSequence, 5, '0', STR_PAD_LEFT);
        }


        $transaction = Transaction::create([
            'name' => Auth::user()->name,
            'company_name' => $request->company,
            'transaction_id' => $transactionId,
            'status' => 1,
            'stsfaktur' => $request->stsfaktur,
            'faktur' => 0,
            'date_payment' => null,
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
                'tax_price' => $request->tax_price,
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

        $company = Company::first();

        // $latestOrder = Orders::where('job_no', 'LIKE', '%/' . $company->code_name . '-' . $request->job_no . '/%')
        //     ->latest('created_at')
        //     ->first();
        // $prefix = !$latestOrder ? '0001' : 
        //     str_pad((int)substr($latestOrder->job_no, 0, 4) + 1, 4, '0', STR_PAD_LEFT);
        // if ((int)$prefix > 9999) {
        //     $prefix = '0001';
        // }

        $latestOrder = Orders::where('job_no', 'LIKE', 'AT/' . date('ym') . '/%')
            ->latest('created_at')
            ->first();

        // Get the next prefix number
        $prefix = !$latestOrder ? '0001' :
            str_pad((int)substr($latestOrder->job_no, -4) + 1, 4, '0', STR_PAD_LEFT);

        // Reset prefix to 0001 if it exceeds 9999
        if ((int)$prefix > 9999) {
            $prefix = '0001';
        }

        // Generate the final job number
        $jobNumber = 'AT/' . date('ym') . '/' . $prefix;

        $request->validate([
            'job_ref' => 'required|string|max:255',
            'flight_date' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'mawb' => 'required|string|max:255',
            'shipper' => 'required|string|max:255',
        ]);

        Orders::create([
            'transaction_id' => $transactionId,
            'job_type' => $request->job_type,
            // 'job_no' => $request->job_format,
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
