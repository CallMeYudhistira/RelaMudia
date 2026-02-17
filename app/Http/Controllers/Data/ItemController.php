<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MultimediaItem;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = MultimediaItem::with('category')->get();
        return view('pages.data.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.data.items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = MultimediaItem::create($request->validate([
            'name' => 'required|string',
            'category_id' => 'required|numeric',
            'description' => 'nullable|string',
            'price_per_day' => 'required|integer',
            'image' => 'nullable|image',
        ]));

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = now()->format('d-m-Y_') . $image->hashName();
            $image->move(public_path('image/items'), $filename);

            $item->update([
                'image' => $filename
            ]);
        }

        return redirect()->route('items.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = MultimediaItem::find($id);
        $categories = Category::all();
        return view('pages.data.items.edit', compact('categories', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = MultimediaItem::findOrFail($id);

        $item->update($request->validate([
            'name' => 'required|string',
            'category_id' => 'required|numeric',
            'description' => 'nullable|string',
            'price_per_day' => 'required|integer',
        ]));

        $request->validate([
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            if (file_exists(public_path('image/items/' . $item->image))) {
                unlink(public_path('image/items/' . $item->image));
            }

            $image = $request->file('image');
            $filename = now()->format('d-m-Y_') . $image->hashName();
            $image->move(public_path('image/items'), $filename);

            $item->update([
                'image' => $filename
            ]);
        }

        return redirect()->route('items.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = MultimediaItem::findOrFail($id);

        if (file_exists(public_path('image/items/' . $item->image))) {
            unlink(public_path('image/items/' . $item->image));
        }
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Data berhasil dihapus!');
    }
}
