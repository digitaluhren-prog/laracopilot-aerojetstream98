<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserListing;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminUserListingController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $listings = UserListing::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        $pendingCount = UserListing::where('status', 'pending')->count();
        $approvedCount = UserListing::where('status', 'approved')->count();
        $rejectedCount = UserListing::where('status', 'rejected')->count();
        
        return view('admin.user-listings.index', compact('listings', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }
    
    public function show($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $listing = UserListing::with(['user', 'category'])->findOrFail($id);
        return view('admin.user-listings.show', compact('listing'));
    }
    
    public function approve(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $listing = UserListing::findOrFail($id);
        $listing->status = 'approved';
        $listing->admin_notes = $request->input('admin_notes');
        $listing->save();
        
        return redirect()->route('admin.user-listings.index')
            ->with('success', 'Shpallja u miratua me sukses!');
    }
    
    public function reject(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $listing = UserListing::findOrFail($id);
        $listing->status = 'rejected';
        $listing->admin_notes = $request->input('admin_notes');
        $listing->save();
        
        return redirect()->route('admin.user-listings.index')
            ->with('success', 'Shpallja u refuzua!');
    }
    
    public function edit($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $listing = UserListing::with(['user', 'category'])->findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.user-listings.edit', compact('listing', 'categories'));
    }
    
    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $listing = UserListing::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'city' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string'
        ]);
        
        $listing->update($validated);
        
        return redirect()->route('admin.user-listings.index')
            ->with('success', 'Shpallja u përditësua me sukses!');
    }
    
    public function destroy($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        UserListing::findOrFail($id)->delete();
        
        return redirect()->route('admin.user-listings.index')
            ->with('success', 'Shpallja u fshi me sukses!');
    }
}