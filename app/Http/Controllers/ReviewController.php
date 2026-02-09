<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Listing;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $listingId)
    {
        $listing = Listing::findOrFail($listingId);
        
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'reviewer_name' => 'required|string|max:255',
            'reviewer_email' => 'required|email|max:255',
            'comment' => 'required|string|min:10'
        ], [
            'rating.required' => 'Vlerësimi është i detyrueshëm',
            'rating.min' => 'Vlerësimi duhet të jetë midis 1 dhe 5',
            'rating.max' => 'Vlerësimi duhet të jetë midis 1 dhe 5',
            'reviewer_name.required' => 'Emri është i detyrueshëm',
            'reviewer_email.required' => 'Email është i detyrueshëm',
            'reviewer_email.email' => 'Email nuk është valid',
            'comment.required' => 'Komenti është i detyrueshëm',
            'comment.min' => 'Komenti duhet të ketë të paktën 10 karaktere'
        ]);
        
        $validated['listing_id'] = $listing->id;
        $validated['user_id'] = session('user_id');
        $validated['approved'] = false;
        
        Review::create($validated);
        
        return redirect()->route('listing.show', $listing->id)
            ->with('success', 'Faleminderit për vlerësimin tuaj! Do të shfaqet pas moderimit nga administratorët.');
    }
}