<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $categories = Category::withCount('listings')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:10',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean'
        ]);

        $validated['active'] = $request->has('active') ? true : false;

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategoria u krijua me sukses!');
    }

    public function edit($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:10',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean'
        ]);

        $validated['active'] = $request->has('active') ? true : false;

        $category = Category::findOrFail($id);
        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategoria u përditësua me sukses!');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $category = Category::findOrFail($id);
        
        if ($category->listings()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Nuk mund të fshihet kategori që ka shpallje aktive!');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategoria u fshi me sukses!');
    }
}