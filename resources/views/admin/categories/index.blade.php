@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Kategoritë</h1>
            <p class="text-gray-600 mt-2">Menaxho kategoritë e shpalljeve</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center">
            <span class="text-xl mr-2">➕</span>
            Shto Kategori të Re
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center">
        <span class="text-xl mr-3">✅</span>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-700 to-gray-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Ikona</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Emri</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Përshkrimi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Shpallje</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Statusi</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-white uppercase tracking-wider">Veprime</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($categories as $category)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 w-14 h-14 rounded-xl flex items-center justify-center shadow-md">
                                <span class="text-3xl">{{ $category->icon }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900">{{ $category->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600 max-w-xs truncate">{{ $category->description }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                {{ $category->listings_count }} shpallje
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($category->active)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                <span class="mr-1">✓</span> Aktive
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800">
                                <span class="mr-1">○</span> Joaktive
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-900 font-bold mr-4 inline-flex items-center">
                                <span class="mr-1">✏️</span> Ndrysho
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Jeni i sigurt që dëshironi të fshini këtë kategori?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-bold inline-flex items-center">
                                    <span class="mr-1">🗑️</span> Fshi
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if($categories->isEmpty())
    <div class="text-center py-16">
        <div class="text-6xl mb-4">📁</div>
        <h3 class="text-xl font-bold text-gray-600 mb-2">Asnjë kategori ende</h3>
        <p class="text-gray-500 mb-6">Fillo duke shtuar kategorinë e parë</p>
        <a href="{{ route('admin.categories.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold transition">
            Shto Kategori të Re
        </a>
    </div>
    @endif

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
@endsection
