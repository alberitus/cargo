<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;


class ItemController extends Controller
{
    function index()
    {
        $item = Item::get();
        return view('item.index', compact('item'));
    }

    function submit(Request $request)
    {
        $item = new Item();
        $item->nama_item = $request->nama_item;
        $item->qty = $request->qty;
        $item->satuan = $request->satuan;
        $item->save();

        return redirect()->route('item.index')->with('success', 'Item created successfully.');
    }

    function update(Request $request, $item_id)
    {
        $item = Item::find($item_id);
        if (!$item) {
            return redirect()->route('item.index')->with('error', 'Item not found');
        }
        $item->nama_item = $request->nama_item;
        $item->qty = $request->qty;
        $item->satuan = $request->satuan;
        $item->update();

        return redirect()->route('item.index')->with('success', 'Item update successfully.');
    }

    function destroy($item_id)
    {
        $item = Item::find($item_id);
        $item->delete();

        return redirect()->route('item.index')->with('success', 'Item deleted successfully.');
    }
}
