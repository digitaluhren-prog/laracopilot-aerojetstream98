<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;
use App\Models\UserListing;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('listings')->get();
        
        $featuredListings = Listing::with('category')
            ->where('average_rating', '>', 0)
            ->orderBy('average_rating', 'desc')
            ->orderBy('total_reviews', 'desc')
            ->take(3)
            ->get();
        
        $popularListings = Listing::with('category')
            ->orderBy('views', 'desc')
            ->take(3)
            ->get();
        
        $recentListings = Listing::with('category')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        
        $userListings = UserListing::with(['category', 'user'])
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        
        return view('home', compact(
            'categories',
            'featuredListings',
            'popularListings',
            'recentListings',
            'userListings'
        ));
    }
    
    public function search(Request $request)
    {
        $query = Listing::with('category');
        
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('description', 'like', '%' . $keyword . '%')
                  ->orWhere('city', 'like', '%' . $keyword . '%');
            });
        }
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }
        
        $listings = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = Category::all();
        
        return view('search', compact('listings', 'categories'));
    }
    
    public function show($id)
    {
        $listing = Listing::with(['category', 'approvedReviews.user'])->findOrFail($id);
        
        $listing->increment('views');
        
        $relatedListings = Listing::where('category_id', $listing->category_id)
            ->where('id', '!=', $listing->id)
            ->take(3)
            ->get();
        
        return view('listing-detail', compact('listing', 'relatedListings'));
    }
}