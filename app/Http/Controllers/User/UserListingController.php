<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\UserListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserListingController extends Controller
{
    public function index()
{
    $userId = session('user_id');

    $listings = UserListing::where('user_id', $userId)
        ->latest()
        ->paginate(10);

    $approvedCount = UserListing::where('user_id', $userId)->where('status', 'approved')->count();
    $pendingCount = UserListing::where('user_id', $userId)->where('status', 'pending')->count();
    $rejectedCount = UserListing::where('user_id', $userId)->where('status', 'rejected')->count();

    return view('user.listings.index', compact(
        'listings',
        'approvedCount',
        'pendingCount',
        'rejectedCount'
    ));
}

    
    public function create()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $categories = Category::all();
        return view('user.listings.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'price' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1536'
        ], [
            'title.required' => 'Titulli është i detyrueshëm',
            'category_id.required' => 'Kategoria është e detyrueshme',
            'description.required' => 'Përshkrimi është i detyrueshëm',
            'city.required' => 'Qyteti është i detyrueshëm',
            'images.*.image' => 'Skedari duhet të jetë foto',
            'images.*.mimes' => 'Foto duhet të jetë JPG, PNG ose WEBP',
            'images.*.max' => 'Çdo foto duhet të jetë maksimum 1.5MB'
        ]);
        
        $imagePaths = [];
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            
            if (count($images) > 5) {
                return back()->withErrors(['images' => 'Maksimumi 5 foto lejohen'])->withInput();
            }
            
            foreach ($images as $image) {
                $path = $image->store('user-listings', 'public');
                $imagePaths[] = $path;
            }
        }
        
        UserListing::create([
            'user_id' => session('user_id'),
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'city' => $validated['city'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'price' => $validated['price'],
            'images' => !empty($imagePaths) ? $imagePaths : null,
            'status' => 'pending'
        ]);
        
        return redirect()->route('user.listings.index')
            ->with('success', 'Shpallja u krijua me sukses! Pritet miratimi nga administratorët.');
    }
    
    public function show($id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $listing = UserListing::with('category')
            ->where('user_id', session('user_id'))
            ->findOrFail($id);
        
        return view('user.listings.show', compact('listing'));
    }
    
    public function edit($id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $listing = UserListing::where('user_id', session('user_id'))->findOrFail($id);
        
        if ($listing->status === 'approved') {
            return redirect()->route('user.listings.show', $id)
                ->with('error', 'Shpalljet e miratuara mund të modifikohen vetëm nga administratorët.');
        }
        
        $categories = Category::all();
        return view('user.listings.edit', compact('listing', 'categories'));
    }
    
    public function update(Request $request, $id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $listing = UserListing::where('user_id', session('user_id'))->findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'price' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1536',
            'delete_images' => 'nullable|array'
        ], [
            'title.required' => 'Titulli është i detyrueshëm',
            'category_id.required' => 'Kategoria është e detyrueshme',
            'description.required' => 'Përshkrimi është i detyrueshëm',
            'city.required' => 'Qyteti është i detyrueshëm',
            'images.*.image' => 'Skedari duhet të jetë foto',
            'images.*.mimes' => 'Foto duhet të jetë JPG, PNG ose WEBP',
            'images.*.max' => 'Çdo foto duhet të jetë maksimum 1.5MB'
        ]);
        
        $currentImages = $listing->images ?? [];
        
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $index) {
                if (isset($currentImages[$index])) {
                    Storage::disk('public')->delete($currentImages[$index]);
                    unset($currentImages[$index]);
                }
            }
            $currentImages = array_values($currentImages);
        }
        
        if ($request->hasFile('images')) {
            $newImages = $request->file('images');
            
            if (count($currentImages) + count($newImages) > 5) {
                return back()->withErrors(['images' => 'Maksimumi 5 foto totale lejohen'])->withInput();
            }
            
            foreach ($newImages as $image) {
                $path = $image->store('user-listings', 'public');
                $currentImages[] = $path;
            }
        }
        
        $listing->update([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'city' => $validated['city'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'price' => $validated['price'],
            'images' => !empty($currentImages) ? $currentImages : null
        ]);
        
        return redirect()->route('user.listings.show', $listing->id)
            ->with('success', 'Shpallja u përditësua me sukses!');
    }
    
    public function destroy($id)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }
        
        $listing = UserListing::where('user_id', session('user_id'))->findOrFail($id);
        
        if ($listing->images) {
            foreach ($listing->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        $listing->delete();
        
        return redirect()->route('user.listings.index')
            ->with('success', 'Shpallja u fshi me sukses!');
    }
}