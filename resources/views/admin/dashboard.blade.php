@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm">Shpallje Totale</p>
                <p class="text-3xl font-bold mt-2">{{ $totalListings }}</p>
            </div>
            <div class="text-5xl opacity-50">📋</div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm">Shpallje Aktive</p>
                <p class="text-3xl font-bold mt-2">{{ $activeListings }}</p>
            </div>
            <div class="text-5xl opacity-50">✅</div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-purple-500 to-purple-700 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-sm">Kategoritë</p>
                <p class="text-3xl font-bold mt-2">{{ $totalCategories }}</p>
            </div>
            <div class="text-5xl opacity-50">📁</div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-orange-500 to-orange-700 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-orange-100 text-sm">Shikime Totale</p>
                <p class="text-3xl font-bold mt-2">{{ number_format($totalViews) }}</p>
            </div>
            <div class="text-5xl opacity-50">👁️</div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Shpalljet e Fundit</h3>
        <div class="space-y-4">
            @foreach($recentListings as $listing)
            <div class="flex items-center justify-between border-b pb-3">
                <div class="flex-1">
                    <p class="font-bold text-gray-800">{{ Str::limit($listing->title, 40) }}</p>
                    <p class="text-sm text-gray-600">{{ $listing->category->name }} • {{ $listing->city }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="flex items-center text-gray-500 text-sm">
                        <span class="mr-1">👁️</span>
                        <span>{{ number_format($listing->views) }}</span>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $listing->active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $listing->active ? 'Aktiv' : 'Jo-aktiv' }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
        <a href="{{ route('admin.listings.index') }}" class="block mt-4 text-center text-blue-600 hover:underline font-bold">
            Shiko të gjitha →
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Shpalljet më të Popullarët</h3>
        <div class="space-y-4">
            @foreach($popularListings as $listing)
            <div class="flex items-center justify-between border-b pb-3">
                <div class="flex-1">
                    <p class="font-bold text-gray-800">{{ Str::limit($listing->title, 40) }}</p>
                    <p class="text-sm text-gray-600">{{ $listing->category->name }} • {{ $listing->city }}</p>
                </div>
                <div class="flex items-center bg-orange-100 text-orange-800 px-3 py-1 rounded-full">
                    <span class="mr-1">👁️</span>
                    <span class="font-bold">{{ number_format($listing->views) }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="mt-8 bg-white rounded-lg shadow-lg p-6">
    <h3 class="text-xl font-bold text-gray-800 mb-4">Veprime të Shpejta</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('admin.listings.create') }}" class="bg-gradient-to-br from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 text-white rounded-lg p-6 text-center transition">
            <div class="text-4xl mb-2">➕</div>
            <p class="font-bold">Shto Shpallje të Re</p>
        </a>
        <a href="{{ route('admin.categories.create') }}" class="bg-gradient-to-br from-purple-500 to-purple-700 hover:from-purple-600 hover:to-purple-800 text-white rounded-lg p-6 text-center transition">
            <div class="text-4xl mb-2">📁</div>
            <p class="font-bold">Shto Kategori të Re</p>
        </a>
        <a href="{{ route('home') }}" target="_blank" class="bg-gradient-to-br from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white rounded-lg p-6 text-center transition">
            <div class="text-4xl mb-2">🌐</div>
            <p class="font-bold">Shiko Faqen Kryesore</p>
        </a>
    </div>
</div>
@endsection