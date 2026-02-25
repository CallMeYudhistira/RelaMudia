<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MultimediaItem;
use App\Models\Rental;
use App\Models\RentalDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function admin()
    {
        // 1. Overview Statistics
        $total_revenue = Rental::whereIn('status', ['paid', 'ongoing', 'completed'])->sum('total_price');
        $active_rentals = Rental::where('status', 'ongoing')->count();
        $total_items = MultimediaItem::count();
        $total_users = User::where('role', 'user')->count();

        // 2. Transaction Status Counts
        $status_counts = Rental::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // 3. Revenue Chart Data (Last 6 Months)
        $months = [];
        $revenues = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->translatedFormat('F');
            $revenues[] = Rental::whereIn('status', ['paid', 'ongoing', 'completed'])
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total_price');
        }

        // 4. Top 5 Most Rented Items
        $top_items = RentalDetail::select('multimedia_item_id', DB::raw('SUM(quantity) as total_rented'))
            ->groupBy('multimedia_item_id')
            ->orderByDesc('total_rented')
            ->with('multimediaItem')
            ->limit(5)
            ->get();

        // 5. Recent Transactions
        $recent_transactions = Rental::with('user')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('pages.dashboard.admin', compact(
            'total_revenue',
            'active_rentals',
            'total_items',
            'total_users',
            'status_counts',
            'months',
            'revenues',
            'top_items',
            'recent_transactions'
        ));
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
