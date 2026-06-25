<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Analisis Sentimen Rating
        $positive = DB::table('reviews')
            ->whereBetween('rating', [4, 5])
            ->count();

        $neutral = DB::table('reviews')
            ->where('rating', 3)
            ->count();

        $negative = DB::table('reviews')
            ->whereBetween('rating', [1, 2])
            ->count();

        // Statistik Kupon
        $activeCoupons = DB::table('coupons')
            ->where('expires_at', '>', now())
            ->count();

        $expiredCoupons = DB::table('coupons')
            ->where('expires_at', '<=', now())
            ->count();

        $totalCouponUsage = DB::table('coupons')
            ->sum('used_count');

        return view('reports.index', compact(
            'positive',
            'neutral',
            'negative',
            'activeCoupons',
            'expiredCoupons',
            'totalCouponUsage'
        ));
    }
}
