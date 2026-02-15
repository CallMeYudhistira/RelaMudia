<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MultimediaItem;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $search = $request->search;
        $category_id = $request->category_id;

        $query = MultimediaItem::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }
        if ($category_id) {
            $query->where('category_id', 'LIKE', "%{$category_id}%");
        }

        $items = $query->with('category')->get();

        return view('pages.items.index', compact('categories', 'items', 'search', 'category_id'));
    }

    public function detail($id)
    {
        $item = MultimediaItem::with('category')->find($id);

        return view('pages.items.detail', compact('item'));
    }
}
