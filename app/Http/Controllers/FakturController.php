<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class FakturController extends Controller
{
    function Index()
    {
        $faktur = Transaction::where('stsfaktur', 1)->get();
        return view('faktur.index', compact('faktur'));
    }

    function update(Request $request, $transaction_id)
    {
        $faktur = Transaction::find($transaction_id);
        if (!$faktur) {
            Alert::error('Error', 'Transaction not found!');
            return redirect()->route('faktur.index');
        }
        $faktur->fraktur = $request->faktur;

        $faktur->update();

        Alert::success('Success', 'Success Input No Faktur!');
        return redirect()->route('faktur.index');
    }
}
