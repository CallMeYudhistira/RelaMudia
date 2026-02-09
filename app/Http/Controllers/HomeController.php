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

    public function user()
    {
        $categories = Category::limit(3)->get();
        $items = MultimediaItem::limit(3)->get();

        return view('pages.dashboard.user', compact('categories', 'items'));
    }
}
