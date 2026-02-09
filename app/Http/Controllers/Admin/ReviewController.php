<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $reviews = Review::with(['listing', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        $pendingCount = Review::where('approved', false)->count();
        
        return view('admin.reviews.index', compact('reviews', 'pendingCount'));
    }
    
    public function approve($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $review = Review::findOrFail($id);
        $review->approved = true;
        $review->save();
        
        $review->listing->updateRating();
        
        return redirect()->route('admin.reviews.index')
            ->with('success', 'Vlerësimi u miratua me sukses!');
    }
    
    public function reject($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $review = Review::findOrFail($id);
        $review->approved = false;
        $review->save();
        
        $review->listing->updateRating();
        
        return redirect()->route('admin.reviews.index')
            ->with('success', 'Vlerësimi u refuzua!');
    }
    
    public function destroy($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $review = Review::findOrFail($id);
        $listing = $review->listing;
        $review->delete();
        
        $listing->updateRating();
        
        return redirect()->route('admin.reviews.index')
            ->with('success', 'Vlerësimi u fshi me sukses!');
    }
}