@extends('layouts.app')

@section('title', 'Ballina - Shqiptarët në Gjermani')

@section('content')
<div class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-6">🇦🇱 Shqiptarët në Gjermani</h1>
        <p class="text-xl md:text-2xl text-red-100 mb-8">Platforma më e madhe për komunitetin shqiptar në Gjermani</p>
        
        <form action="{{ route('search') }}" method="GET" class="max-w-3xl mx-auto">
            <div class="flex flex-col md:flex-row gap-4">
                <input type="text" name="keyword" placeholder="Kërko shërbime, biznese..." class="flex-1 px-6 py-4 rounded-lg text-gray-800 text-lg focus:outline-none focus:ring-4 focus:ring-red-300">
                <select name="category" class="px-6 py-4 rounded-lg text-gray-800 text-lg focus:outline-none focus:ring-4 focus:ring-red-300">
                    <option value="">Të gjitha kategoritë</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-white text-red-600 px-8 py-4 rounded-lg font-bold text-lg hover:bg-red-50 transition duration-300">
                    🔍 Kërko
                </button>
            </div>
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">📁 Kategoritë Kryesore</h2>
        <p class="text-gray-600 text-lg">Shfleto shërbimet sipas kategorive</p>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-16">
        @foreach($categories as $category)
        <a href="{{ route('search', ['category' => $category->id]) }}" class="bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 p-6 text-center group">
            <div class="text-4xl mb-3">{{ $category->icon }}</div>
            <h3 class="font-bold text-gray-800 group-hover:text-red-600 transition">{{ $category->name }}</h3>
            <p class="text-sm text-gray-600 mt-1">{{ $category->listings_count }} shpallje</p>
        </a>
        @endforeach
    </div>
</div>

<div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">⭐ Shpalljet më të Vlerësuara</h2>
            <p class="text-blue-100 text-lg">Bizneset me vlerësimin më të lartë nga komuniteti</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredListings as $listing)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">{{ $listing->category->name }}</span>
                        <div class="flex items-center">
                            <span class="text-yellow-500 text-xl mr-1">⭐</span>
                            <span class="font-bold text-gray-800">{{ number_format($listing->average_rating, 1) }}</span>
                            <span class="text-gray-600 text-sm ml-1">({{ $listing->total_reviews }})</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $listing->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($listing->description, 100) }}</p>
                    <div class="flex items-center text-gray-600 text-sm mb-4">
                        <span class="mr-2">📍</span>
                        <span>{{ $listing->city }}</span>
                    </div>
                    <a href="{{ route('listing.show', $listing->id) }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition">
                        Shiko Detajet
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">🔥 Shpalljet më të Populluara</h2>
        <p class="text-gray-600 text-lg">Shpalljet më të shikuara këtë javë</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($popularListings as $listing)
        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <span class="inline-block bg-red-100 text-red-800 text-sm px-3 py-1 rounded-full">{{ $listing->category->name }}</span>
                    <div class="flex items-center text-gray-600">
                        <span class="mr-1">👁️</span>
                        <span class="font-bold">{{ $listing->views }}</span>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $listing->name }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($listing->description, 100) }}</p>
                <div class="flex items-center text-gray-600 text-sm mb-4">
                    <span class="mr-2">📍</span>
                    <span>{{ $listing->city }}</span>
                </div>
                @if($listing->average_rating > 0)
                <div class="flex items-center mb-4">
                    <span class="text-yellow-500 mr-1">⭐</span>
                    <span class="font-bold text-gray-800">{{ number_format($listing->average_rating, 1) }}</span>
                    <span class="text-gray-600 text-sm ml-1">({{ $listing->total_reviews }} vlerësime)</span>
                </div>
                @endif
                <a href="{{ route('listing.show', $listing->id) }}" class="block text-center bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-lg transition">
                    Shiko Detajet
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="bg-gradient-to-r from-purple-500 to-purple-700 text-white py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">👥 Shpalljet e Përdoruesve</h2>
            <p class="text-purple-100 text-lg">Shpalljet më të reja nga anëtarët e komunitetit</p>
        </div>
        
        @if($userListings->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            @foreach($userListings as $listing)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                @if($listing->first_image)
                <img src="{{ $listing->first_image }}" alt="{{ $listing->title }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                    <span class="text-8xl">{{ $listing->category->icon }}</span>
                </div>
                @endif
                <div class="p-5">
                    <div class="flex items-center justify-between mb-3">
                        <span class="inline-block bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">{{ $listing->category->name }}</span>
                        @if($listing->price)
                        <span class="font-bold text-green-600 text-sm">{{ number_format($listing->price, 2) }}€</span>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ Str::limit($listing->title, 40) }}</h3>
                    <p class="text-gray-600 text-sm mb-3">{{ Str::limit($listing->description, 80) }}</p>
                    <div class="flex items-center text-gray-600 text-xs mb-3">
                        <span class="mr-1">📍</span>
                        <span>{{ $listing->city }}</span>
                    </div>
                    <div class="flex items-center text-gray-500 text-xs mb-3">
                        <span class="mr-1">👤</span>
                        <span>{{ $listing->user->name }}</span>
                    </div>
                    <a href="{{ route('public.user-listing.show', $listing->id) }}" class="block text-center bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 rounded-lg transition text-sm">
                        Shiko Detajet
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center">
            <a href="{{ route('public.user-listings') }}" class="inline-block bg-white text-purple-600 font-bold px-8 py-4 rounded-lg hover:bg-purple-50 transition text-lg">
                Shiko të Gjitha Shpalljet e Përdoruesve →
            </a>
        </div>
        @else
        <div class="bg-purple-600 rounded-lg p-8 text-center">
            <p class="text-xl mb-6">Ende nuk ka shpallje nga përdoruesit</p>
            @if(session('user_logged_in'))
            <a href="{{ route('user.listings.create') }}" class="inline-block bg-white text-purple-600 font-bold px-6 py-3 rounded-lg hover:bg-purple-50 transition">
                ➕ Bëhu i Pari që Publikon
            </a>
            @else
            <a href="{{ route('user.register') }}" class="inline-block bg-white text-purple-600 font-bold px-6 py-3 rounded-lg hover:bg-purple-50 transition">
                📝 Regjistrohu për të Publikuar
            </a>
            @endif
        </div>
        @endif
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">🆕 Shpalljet më të Fundit</h2>
        <p class="text-gray-600 text-lg">Bizneset që u shtuan kohët e fundit</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach($recentListings as $listing)
        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
            <div class="p-5">
                <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full mb-3">{{ $listing->category->name }}</span>
                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ Str::limit($listing->name, 40) }}</h3>
                <p class="text-gray-600 text-sm mb-3">{{ Str::limit($listing->description, 80) }}</p>
                <div class="flex items-center text-gray-600 text-xs mb-4">
                    <span class="mr-1">📍</span>
                    <span>{{ $listing->city }}</span>
                </div>
                <a href="{{ route('listing.show', $listing->id) }}" class="block text-center bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 rounded-lg transition text-sm">
                    Shiko Detajet
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="bg-gray-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="text-center">
                <div class="text-5xl mb-4">🎯</div>
                <h3 class="text-2xl font-bold mb-4">Gjej Shërbime</h3>
                <p class="text-gray-300">Mijëra biznese dhe shërbime shqiptare në Gjermani</p>
            </div>
            <div class="text-center">
                <div class="text-5xl mb-4">⭐</div>
                <h3 class="text-2xl font-bold mb-4">Vlerësime të Besueshme</h3>
                <p class="text-gray-300">Shiko vlerësimet dhe komentet nga komuniteti</p>
            </div>
            <div class="text-center">
                <div class="text-5xl mb-4">📱</div>
                <h3 class="text-2xl font-bold mb-4">Kontakt i Lehtë</h3>
                <p class="text-gray-300">Telefono ose dërgo email direkt nga platforma</p>
            </div>
        </div>
    </div>
</div>
@endsection
