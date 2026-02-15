<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MultimediaItem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin()
    {
        return view('pages.dashboard.admin');
    }

    public function user(Request $request)
    {
        $category_id = $request->category_id;

        $query = MultimediaItem::query();
        if ($category_id) {
            $query->where('category_id', $category_id);
        }
        $categories = Category::limit(3)->get();
        $items = $query->limit(15)->get();

        return view('pages.dashboard.user', compact('categories', 'items', 'category_id'));
    }
}
