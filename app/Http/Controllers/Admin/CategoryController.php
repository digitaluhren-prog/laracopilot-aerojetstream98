<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('listings')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.categories.index', compact('categories'));
    }
    
    public function create()
    {
        return view('admin.categories.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:10',
            'description' => 'nullable|string|max:1000',
            'active' => 'nullable|boolean'
        ]);
        
        $validated['active'] = $request->has('active') ? true : false;
        
        Category::create($validated);
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategoria u krijua me sukses!');
    }
    
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }
    
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:10',
            'description' => 'nullable|string|max:1000',
            'active' => 'nullable|boolean'
        ]);
        
        $validated['active'] = $request->has('active') ? true : false;
        
        $category->update($validated);
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategoria u përditësua me sukses!');
    }
    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        if ($category->listings()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Nuk mund të fshini këtë kategori sepse ka shpallje të lidhura!');
        }
        
        $category->delete();
        
        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategoria u fshi me sukses!');
    }
}