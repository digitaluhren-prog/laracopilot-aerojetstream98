@extends('layouts.app')

@section('title', 'Kërko - Shqiptarët në Gjermani')

@section('content')
<div class="gradient-bg text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl font-bold mb-6">Kërko Shpallje</h1>
        
        <form action="{{ route('search') }}" method="GET" class="bg-white rounded-lg shadow-xl p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Kategoria</label>
                    <select name="category" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-red-500">
                        <option value="">Të gjitha</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Qyteti</label>
                    <input type="text" name="city" value="{{ request('city') }}" placeholder="p.sh. Berlin, München..." class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-red-500">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Fjalë kyçe</label>
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Kërko..." class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-red-500">
                </div>
            </div>
            <button type="submit" class="w-full mt-4 bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition duration-300">
                🔍 Kërko
            </button>
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-6">
        <p class="text-gray-600">U gjetën <strong>{{ $listings->total() }}</strong> rezultate</p>
    </div>
    
    @if($listings->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($listings as $listing)
        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
            @if($listing->featured)
            <div class="gradient-bg text-white px-4 py-2 text-sm font-bold">⭐ I Zgjedhur</div>
            @endif
            <div class="p-6">
                <div class="flex justify-between items-start mb-3">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">{{ $listing->category->name }}</span>
                    <div class="flex items-center text-gray-400 text-xs">
                        <span class="mr-1">👁️</span>
                        <span>{{ number_format($listing->views) }}</span>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $listing->title }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($listing->description, 120) }}</p>
                <div class="flex items-center text-gray-600 text-sm mb-2">
                    <span class="mr-2">📍</span>
                    <span>{{ $listing->city }}</span>
                </div>
                @if($listing->phone)
                <div class="flex items-center text-gray-600 text-sm mb-4">
                    <span class="mr-2">📞</span>
                    <span>{{ $listing->phone }}</span>
                </div>
                @endif
                <a href="{{ route('listing.show', $listing->id) }}" class="block text-center bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-lg transition">
                    Shiko Detajet
                </a>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $listings->links() }}
    </div>
    @else
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded">
        <p class="text-yellow-800 text-lg">Nuk u gjetën rezultate për kërkimin tuaj. Provoni me kritere të tjera.</p>
    </div>
    @endif
</div>
@endsection