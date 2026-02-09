@extends('layouts.admin')

@section('title', 'Kategoritë - Admin Panel')
@section('page-title', 'Menaxhimi i Kategorive')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <p class="text-gray-600">Totali: <strong>{{ $categories->total() }}</strong> kategori</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3 rounded-lg transition">
        ➕ Shto Kategori të Re
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
    {{ $errors->first() }}
</div>
@endif

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-4 text-left text-gray-700 font-bold">Emri</th>
                <th class="px-6 py-4 text-left text-gray-700 font-bold">Përshkrimi</th>
                <th class="px-6 py-4 text-center text-gray-700 font-bold">Shpallje</th>
                <th class="px-6 py-4 text-right text-gray-700 font-bold">Veprime</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-6 py-4">
                    <span class="font-bold text-gray-800">{{ $category->name }}</span>
                </td>
                <td class="px-6 py-4 text-gray-600">
                    {{ Str::limit($category->description, 80) }}
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-bold">
                        {{ $category->listings_count }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-600 hover:underline mr-4">Ndrysho</a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Jeni i sigurt që dëshironi ta fshini këtë kategori?')">
                            Fshi
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                    Nuk ka kategori. <a href="{{ route('admin.categories.create') }}" class="text-blue-600 hover:underline">Shto kategorinë e parë</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $categories->links() }}
</div>
@endsection
