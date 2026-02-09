<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Category;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $totalListings = Listing::count();
        $activeListings = Listing::where('active', true)->count();
        $totalCategories = Category::count();
        $totalUsers = User::count();
        $totalViews = Listing::sum('views');
        
        $recentListings = Listing::with('category')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        $popularListings = Listing::with('category')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
        
        $listingsByCategory = Category::withCount('listings')
            ->orderBy('listings_count', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalListings',
            'activeListings',
            'totalCategories',
            'totalUsers',
            'totalViews',
            'recentListings',
            'popularListings',
            'listingsByCategory'
        ));
    }
}