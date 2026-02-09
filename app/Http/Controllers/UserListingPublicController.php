<?php

namespace App\Http\Controllers;

use App\Models\UserListing;
use App\Models\Category;
use Illuminate\Http\Request;

class UserListingPublicController extends Controller
{
    public function index(Request $request)
    {
        $query = UserListing::where('status', 'approved')->with(['category', 'user']);
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }
        
        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('description', 'like', '%' . $request->keyword . '%');
            });
        }
        
        $listings = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = Category::all();
        
        return view('public.user-listings', compact('listings', 'categories'));
    }
    
    public function show($id)
    {
        $listing = UserListing::where('status', 'approved')
            ->with(['category', 'user'])
            ->findOrFail($id);
        
        $relatedListings = UserListing::where('status', 'approved')
            ->where('category_id', $listing->category_id)
            ->where('id', '!=', $listing->id)
            ->take(3)
            ->get();
        
        return view('public.user-listing-detail', compact('listing', 'relatedListings'));
    }
}