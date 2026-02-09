<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Category;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $listings = Listing::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.listings.index', compact('listings'));
    }
    
    public function create()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $categories = Category::orderBy('name')->get();
        return view('admin.listings.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'city' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'active' => 'boolean',
            'featured' => 'boolean'
        ], [
            'title.required' => 'Titulli është i detyrueshëm',
            'description.required' => 'Përshkrimi është i detyrueshëm',
            'category_id.required' => 'Kategoria është e detyrueshme',
            'city.required' => 'Qyteti është i detyrueshëm'
        ]);
        
        $validated['active'] = $request->has('active');
        $validated['featured'] = $request->has('featured');
        
        Listing::create($validated);
        
        return redirect()->route('admin.listings.index')
            ->with('success', 'Shpallja u krijua me sukses!');
    }
    
    public function edit($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $listing = Listing::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.listings.edit', compact('listing', 'categories'));
    }
    
    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        $listing = Listing::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'city' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'active' => 'boolean',
            'featured' => 'boolean'
        ], [
            'title.required' => 'Titulli është i detyrueshëm',
            'description.required' => 'Përshkrimi është i detyrueshëm',
            'category_id.required' => 'Kategoria është e detyrueshme',
            'city.required' => 'Qyteti është i detyrueshëm'
        ]);
        
        $validated['active'] = $request->has('active');
        $validated['featured'] = $request->has('featured');
        
        $listing->update($validated);
        
        return redirect()->route('admin.listings.index')
            ->with('success', 'Shpallja u përditësua me sukses!');
    }
    
    public function destroy($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        
        Listing::findOrFail($id)->delete();
        
        return redirect()->route('admin.listings.index')
            ->with('success', 'Shpallja u fshi me sukses!');
    }
}