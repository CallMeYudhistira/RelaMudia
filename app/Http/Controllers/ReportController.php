<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\RentalDetail;
use App\Models\User;
use App\Models\MultimediaItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'sales'); // sales, customer, item
        $period = $request->get('period', 'monthly');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = Rental::whereIn('status', ['paid', 'ongoing', 'completed']);

        // Filtering by period
        if ($period == 'daily') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($period == 'weekly') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($period == 'monthly') {
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
        } elseif ($period == 'yearly') {
            $query->whereYear('created_at', Carbon::now()->year);
        } elseif ($period == 'custom' && $startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // --- Summary Stats ---
        $turnover = (clone $query)->sum('total_price');
        
        $top_customer = (clone $query)->select('user_id', DB::raw('SUM(total_price) as total_spent'))
            ->groupBy('user_id')
            ->orderByDesc('total_spent')
            ->with('user')
            ->first();

        $top_item = RentalDetail::whereHas('rental', function($q) use ($query) {
                $q->whereIn('id', (clone $query)->pluck('id'));
            })
            ->select('multimedia_item_id', DB::raw('SUM(quantity) as total_rented'))
            ->groupBy('multimedia_item_id')
            ->orderByDesc('total_rented')
            ->with('multimediaItem')
            ->first();

        // --- Data for Report Table ---
        $data = collect();
        if ($type == 'sales') {
            $data = (clone $query)->with('user')->orderBy('created_at', 'desc')->get();
        } elseif ($type == 'customer') {
            $data = (clone $query)->select('user_id', DB::raw('SUM(total_price) as total_spent'), DB::raw('COUNT(*) as total_rentals'))
                ->groupBy('user_id')
                ->orderByDesc('total_spent')
                ->with('user')
                ->get();
        } elseif ($type == 'item') {
            $data = RentalDetail::whereHas('rental', function($q) use ($query) {
                    $q->whereIn('id', (clone $query)->pluck('id'));
                })
                ->select('multimedia_item_id', DB::raw('SUM(quantity) as total_rented'), DB::raw('SUM(subtotal) as total_revenue'))
                ->groupBy('multimedia_item_id')
                ->orderByDesc('total_rented')
                ->with('multimediaItem')
                ->get();
        }

        return view('pages.reports.index', compact('data', 'type', 'period', 'startDate', 'endDate', 'turnover', 'top_customer', 'top_item'));
    }
}
