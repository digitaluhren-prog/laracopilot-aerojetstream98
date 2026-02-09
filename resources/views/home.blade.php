@extends('layouts.app')

@section('title', 'Ballina - Shqiptarët në Gjermani')

@section('content')
<div class="relative bg-gradient-to-br from-red-600 via-red-700 to-black text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-28">
        <div class="text-center">
            <div class="flex justify-center mb-6 sm:mb-8">
                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-4 sm:p-6">
                    <span class="text-6xl sm:text-7xl lg:text-8xl">🇦🇱</span>
                </div>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold mb-4 sm:mb-6 leading-tight">
                Shqiptarët në <span class="text-yellow-400">Gjermani</span>
            </h1>
            <p class="text-lg sm:text-xl lg:text-2xl text-red-100 mb-8 sm:mb-10 max-w-3xl mx-auto leading-relaxed">
                Platforma më e madhe për komunitetin shqiptar në Gjermani. Gjej shërbime, biznese dhe kontakte të besueshme.
            </p>
            
            <form action="{{ route('search') }}" method="GET" class="max-w-5xl mx-auto">
                <div class="bg-white rounded-3xl shadow-2xl p-4 sm:p-6 lg:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 mb-4 sm:mb-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 sm:mb-3 text-left text-sm sm:text-base">
                                <span class="inline-flex items-center">
                                    <span class="text-xl sm:text-2xl mr-2">📁</span>
                                    Kategoria
                                </span>
                            </label>
                            <select name="category" class="w-full px-4 sm:px-5 py-3 sm:py-4 rounded-xl border-2 border-gray-200 text-gray-800 text-sm sm:text-base font-medium focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition appearance-none bg-white hover:border-gray-300 cursor-pointer" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'%23374151\'%3E%3Cpath stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M19 9l-7 7-7-7\'%3E%3C/path%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 1rem center; background-size: 1.5em;">
                                <option value="">Të gjitha kategoritë</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->icon }} {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 sm:mb-3 text-left text-sm sm:text-base">
                                <span class="inline-flex items-center">
                                    <span class="text-xl sm:text-2xl mr-2">📍</span>
                                    Qyteti
                                </span>
                            </label>
                            <input type="text" name="city" value="{{ request('city') }}" placeholder="Berlin, München, Hamburg..." class="w-full px-4 sm:px-5 py-3 sm:py-4 rounded-xl border-2 border-gray-200 text-gray-800 text-sm sm:text-base font-medium focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition hover:border-gray-300">
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 sm:mb-3 text-left text-sm sm:text-base">
                                <span class="inline-flex items-center">
                                    <span class="text-xl sm:text-2xl mr-2">🔍</span>
                                    Fjalë kyçe
                                </span>
                            </label>
                            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Kërko shërbime, biznese, produkte..." class="w-full px-4 sm:px-5 py-3 sm:py-4 rounded-xl border-2 border-gray-200 text-gray-800 text-sm sm:text-base font-medium focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition hover:border-gray-300">
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-6 sm:px-8 py-4 sm:py-5 rounded-xl font-bold text-base sm:text-lg transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-2xl flex items-center justify-center">
                        <span class="text-2xl sm:text-3xl mr-3">🔍</span>
                        <span>Kërko Tani</span>
                    </button>
                </div>
            </form>
            
            <div class="mt-8 sm:mt-12 flex flex-wrap justify-center gap-3 sm:gap-4">
                <div class="bg-white bg-opacity-20 backdrop-blur-sm px-4 sm:px-6 py-2 sm:py-3 rounded-full">
                    <span class="font-bold text-base sm:text-lg">{{ $categories->sum('listings_count') }}+</span> <span class="text-red-100 text-sm sm:text-base">Shpallje Aktive</span>
                </div>
                <div class="bg-white bg-opacity-20 backdrop-blur-sm px-4 sm:px-6 py-2 sm:py-3 rounded-full">
                    <span class="font-bold text-base sm:text-lg">{{ $categories->count() }}+</span> <span class="text-red-100 text-sm sm:text-base">Kategori</span>
                </div>
                <div class="bg-white bg-opacity-20 backdrop-blur-sm px-4 sm:px-6 py-2 sm:py-3 rounded-full">
                    <span class="font-bold text-base sm:text-lg">Gjermani</span> <span class="text-red-100 text-sm sm:text-base">Në të gjithë vendin</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray-50 py-12 sm:py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-16">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-3 sm:mb-4">📁 Kategoritë Kryesore</h2>
            <p class="text-base sm:text-lg lg:text-xl text-gray-600">Eksploro shërbimet sipas kategorive të ndryshme</p>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4 lg:gap-6">
            @foreach($categories as $category)
            <a href="{{ route('search', ['category' => $category->id]) }}" class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 p-4 sm:p-6 text-center transform hover:-translate-y-2">
                <div class="text-4xl sm:text-5xl lg:text-6xl mb-3 sm:mb-4 transform group-hover:scale-110 transition-transform duration-300">{{ $category->icon }}</div>
                <h3 class="font-bold text-gray-900 text-sm sm:text-base lg:text-lg mb-1 sm:mb-2 group-hover:text-red-600 transition">{{ $category->name }}</h3>
                <p class="text-xs sm:text-sm text-gray-500 font-medium">{{ $category->listings_count }} shpallje</p>
            </a>
            @endforeach
        </div>
    </div>
</div>

@if($featuredListings->count() > 0)
<div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white py-12 sm:py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-16">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-3 sm:mb-4">⭐ Bizneset më të Vlerësuara</h2>
            <p class="text-base sm:text-lg lg:text-xl text-blue-100">Komuniteti rekomandon këto shërbime cilësore</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
            @foreach($featuredListings as $listing)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="p-5 sm:p-6 lg:p-8">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs sm:text-sm font-bold px-3 sm:px-4 py-1 sm:py-2 rounded-full">{{ $listing->category->icon }} {{ $listing->category->name }}</span>
                        <div class="flex items-center bg-yellow-100 px-2 sm:px-3 py-1 sm:py-2 rounded-full">
                            <span class="text-yellow-500 text-lg sm:text-xl mr-1">⭐</span>
                            <span class="font-bold text-gray-900 text-sm sm:text-base">{{ number_format($listing->average_rating, 1) }}</span>
                            <span class="text-gray-600 text-xs sm:text-sm ml-1">({{ $listing->total_reviews }})</span>
                        </div>
                    </div>
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-2 sm:mb-3 line-clamp-2">{{ $listing->name }}</h3>
                    <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6 line-clamp-3">{{ $listing->description }}</p>
                    <div class="flex items-center text-gray-500 text-xs sm:text-sm mb-4 sm:mb-6">
                        <span class="mr-2 text-base sm:text-lg">📍</span>
                        <span class="font-medium">{{ $listing->city }}</span>
                    </div>
                    <a href="{{ route('listing.show', $listing->id) }}" class="block text-center bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 sm:py-4 rounded-xl transition-all duration-300 transform hover:scale-105 text-sm sm:text-base">
                        Shiko Detajet →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@if($userListings->count() > 0)
<div class="bg-gradient-to-br from-purple-600 to-purple-800 text-white py-12 sm:py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-16">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-3 sm:mb-4">👥 Shpalljet e Komunitetit</h2>
            <p class="text-base sm:text-lg lg:text-xl text-purple-100">Anëtarët e komunitetit po ofrojnë shërbime dhe produkte</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach($userListings as $listing)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                @if($listing->first_image)
                <div class="relative h-48 sm:h-56 overflow-hidden">
                    <img src="{{ $listing->first_image }}" alt="{{ $listing->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300">
                    @if($listing->price)
                    <div class="absolute top-3 right-3 bg-green-500 text-white font-bold px-3 sm:px-4 py-1 sm:py-2 rounded-full text-xs sm:text-sm shadow-lg">
                        {{ number_format($listing->price, 2) }}€
                    </div>
                    @endif
                </div>
                @else
                <div class="relative h-48 sm:h-56 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center">
                    <span class="text-6xl sm:text-7xl lg:text-8xl">{{ $listing->category->icon }}</span>
                    @if($listing->price)
                    <div class="absolute top-3 right-3 bg-green-500 text-white font-bold px-3 sm:px-4 py-1 sm:py-2 rounded-full text-xs sm:text-sm shadow-lg">
                        {{ number_format($listing->price, 2) }}€
                    </div>
                    @endif
                </div>
                @endif
                <div class="p-4 sm:p-5">
                    <span class="inline-block bg-purple-100 text-purple-800 text-xs font-bold px-2 sm:px-3 py-1 rounded-full mb-3">{{ $listing->category->icon }} {{ $listing->category->name }}</span>
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $listing->title }}</h3>
                    <p class="text-xs sm:text-sm text-gray-600 mb-3 line-clamp-2">{{ $listing->description }}</p>
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                        <div class="flex items-center">
                            <span class="mr-1">📍</span>
                            <span>{{ $listing->city }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-1">👤</span>
                            <span class="truncate max-w-[100px]">{{ $listing->user->name }}</span>
                        </div>
                    </div>
                    <a href="{{ route('public.user-listing.show', $listing->id) }}" class="block text-center bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold py-2 sm:py-3 rounded-xl transition-all duration-300 transform hover:scale-105 text-xs sm:text-sm">
                        Shiko Detajet →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-8 sm:mt-12">
            <a href="{{ route('public.user-listings') }}" class="inline-block bg-white hover:bg-gray-100 text-purple-600 font-bold px-6 sm:px-10 py-3 sm:py-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-xl text-sm sm:text-lg">
                Shiko të Gjitha Shpalljet →
            </a>
        </div>
    </div>
</div>
@endif

@if($popularListings->count() > 0)
<div class="bg-white py-12 sm:py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-16">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-3 sm:mb-4">🔥 Më të Populluarat</h2>
            <p class="text-base sm:text-lg lg:text-xl text-gray-600">Shpalljet më të kërkuara këtë javë</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
            @foreach($popularListings as $listing)
            <div class="bg-gray-50 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2">
                <div class="p-5 sm:p-6 lg:p-8">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <span class="inline-block bg-red-100 text-red-800 text-xs sm:text-sm font-bold px-3 sm:px-4 py-1 sm:py-2 rounded-full">{{ $listing->category->icon }} {{ $listing->category->name }}</span>
                        <div class="flex items-center bg-gray-200 px-2 sm:px-3 py-1 sm:py-2 rounded-full">
                            <span class="mr-1 text-base sm:text-lg">👁️</span>
                            <span class="font-bold text-gray-900 text-xs sm:text-sm">{{ $listing->views }}</span>
                        </div>
                    </div>
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-2 sm:mb-3 line-clamp-2">{{ $listing->name }}</h3>
                    <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6 line-clamp-3">{{ $listing->description }}</p>
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <div class="flex items-center text-gray-500 text-xs sm:text-sm">
                            <span class="mr-2 text-base sm:text-lg">📍</span>
                            <span class="font-medium">{{ $listing->city }}</span>
                        </div>
                        @if($listing->average_rating > 0)
                        <div class="flex items-center">
                            <span class="text-yellow-500 mr-1 text-base sm:text-lg">⭐</span>
                            <span class="font-bold text-gray-900 text-xs sm:text-sm">{{ number_format($listing->average_rating, 1) }}</span>
                        </div>
                        @endif
                    </div>
                    <a href="{{ route('listing.show', $listing->id) }}" class="block text-center bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-3 sm:py-4 rounded-xl transition-all duration-300 transform hover:scale-105 text-sm sm:text-base">
                        Shiko Detajet →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="bg-gradient-to-br from-gray-900 to-gray-800 text-white py-12 sm:py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 sm:gap-12">
            <div class="text-center">
                <div class="bg-gradient-to-br from-red-500 to-red-600 w-16 h-16 sm:w-20 sm:h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-xl">
                    <span class="text-3xl sm:text-4xl">🎯</span>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4">Gjej Shërbime</h3>
                <p class="text-sm sm:text-base text-gray-300 leading-relaxed">Mijëra biznese dhe shërbime shqiptare të verifikuara në të gjithë Gjermaninë</p>
            </div>
            <div class="text-center">
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 w-16 h-16 sm:w-20 sm:h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-xl">
                    <span class="text-3xl sm:text-4xl">⭐</span>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4">Vlerësime Reale</h3>
                <p class="text-sm sm:text-base text-gray-300 leading-relaxed">Lexo përvojat e anëtarëve të tjerë të komunitetit para se të zgjedhësh</p>
            </div>
            <div class="text-center">
                <div class="bg-gradient-to-br from-green-500 to-green-600 w-16 h-16 sm:w-20 sm:h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-xl">
                    <span class="text-3xl sm:text-4xl">📱</span>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold mb-3 sm:mb-4">Kontakt i Lehtë</h3>
                <p class="text-sm sm:text-base text-gray-300 leading-relaxed">Kontakto drejtpërdrejt përmes telefonit ose emailit nga platforma</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-gradient-to-r from-red-600 to-red-700 text-white py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-3 sm:mb-4">Je Biznes ose Oferues Shërbimi?</h3>
            <p class="text-base sm:text-lg lg:text-xl text-red-100 mb-6 sm:mb-8 max-w-3xl mx-auto">Bashkohu me mijëra biznese shqiptare në Gjermani dhe arri klientë të rinj çdo ditë</p>
            <a href="{{ route('user.register') }}" class="inline-block bg-white hover:bg-gray-100 text-red-600 font-bold px-6 sm:px-10 py-3 sm:py-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-xl text-sm sm:text-lg">
                📝 Regjistrohu Falas Tani
            </a>
        </div>
    </div>
</div>
@endsection
