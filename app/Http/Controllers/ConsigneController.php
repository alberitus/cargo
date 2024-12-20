<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consigne;

class ConsigneController extends Controller
{
    function index()
    {
        $consigne = consigne::get();
        return view('consigne.index', compact('consigne'));
    }

    function submit(Request $request)
    {
        $consigne = new consigne();
        $consigne->nama_consigne = $request->nama_consigne;

        $consigne->save();

        return redirect()->route('consigne.index')->with('success', 'consigne created successfully.');
    }

    function update(Request $request, $consigne_id)
    {
        $consigne = consigne::find($consigne_id);

        if (!$consigne) {
            return redirect()->route('consigne.index')->with('error', 'consigne not found');
        }

        $consigne->nama_consigne = $request->nama_consigne;
        $consigne->update();

        return redirect()->route('consigne.index')->with('success', 'consigne updated successfully.');
    }

    function destroy($consigne_id)
    {
        $consigne = consigne::find($consigne_id);

        if (!$consigne) {
            return redirect()->route('consigne.index')->with('error', 'consigne not found');
        }

        $consigne->delete();

        return redirect()->route('consigne.index')->with('success', 'consigne deleted successfully.');
    }
}
