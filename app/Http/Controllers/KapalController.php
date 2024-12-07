<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kapal;

class KapalController extends Controller
{
    function index()
    {
        $kapal = Kapal::get();
        return view('kapal.index', compact('kapal'));
    }

    function submit(Request $request)
    {
        $kapal = new Kapal();
        $kapal->nama_kapal = $request->nama_kapal;

        $kapal->save();

        return redirect()->route('kapal.index')->with('success', 'Kapal created successfully.');
    }

    function update(Request $request, $kapal_id)
    {
        $kapal = Kapal::find($kapal_id);

        if (!$kapal) {
            return redirect()->route('kapal.index')->with('error', 'Kapal not found');
        }

        $kapal->nama_kapal = $request->nama_kapal;
        $kapal->update();

        return redirect()->route('kapal.index')->with('success', 'Kapal updated successfully.');
    }

    function destroy($kapal_id)
    {
        $kapal = Kapal::find($kapal_id);

        if (!$kapal) {
            return redirect()->route('kapal.index')->with('error', 'Kapal not found');
        }

        $kapal->delete();

        return redirect()->route('kapal.index')->with('success', 'Kapal deleted successfully.');
    }
}
