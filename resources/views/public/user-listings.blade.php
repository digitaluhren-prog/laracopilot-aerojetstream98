@extends('layouts.app')

@section('title', 'Shpalljet e Përdoruesve - Shqiptarët në Gjermani')

@section('content')
<div class="gradient-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">Shpalljet e Përdoruesve</h1>
        <p class="text-xl text-red-100 mb-8">Shpalljet nga komuniteti shqiptar në Gjermani</p>
        
        <form action="{{ route('public.user-listings') }}" method="GET" class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-2xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2 text-left">Kategoria</label>
                        <select name="category" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-red-500">
                            <option value="">Të gjitha</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2 text-left">Qyteti</label>
                        <input type="text" name="city" value="{{ request('city') }}" placeholder="p.sh. Berlin, München..." class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2 text-left">Fjalë kyçe</label>
                        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Kërko..." class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-red-500">
                    </div>
                </div>
                <button type="submit" class="w-full mt-4 bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-lg transition duration-300 text-lg">
                    🔍 Kërko
                </button>
            </div>
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-6 flex justify-between items-center">
        <p class="text-gray-600">U gjetën <strong>{{ $listings->total() }}</strong> shpallje</p>
        @if(session('user_logged_in'))
        <a href="{{ route('user.listings.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3 rounded-lg transition">
            ➕ Shto Shpalljen Tënde
        </a>
        @else
        <a href="{{ route('user.login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-lg transition">
            🔑 Hyr për të shtuar shpallje
        </a>
        @endif
    </div>
    
    @if($listings->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($listings as $listing)
        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-start mb-3">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">{{ $listing->category->name }}</span>
                    @if($listing->price)
                    <span class="font-bold text-green-600">{{ number_format($listing->price, 2) }}€</span>
                    @endif
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
                <div class="flex items-center text-gray-500 text-xs mb-4">
                    <span class="mr-2">👤</span>
                    <span>{{ $listing->user->name }}</span>
                </div>
                <a href="{{ route('public.user-listing.show', $listing->id) }}" class="block text-center bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-lg transition">
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

<div class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Dëshironi të Publikoni një Shpallje?</h2>
        <p class="text-gray-600 mb-8 text-lg">Bashkohuni me mijëra shqiptarë që ndajnë shërbimet dhe produktet e tyre</p>
        @if(session('user_logged_in'))
        <a href="{{ route('user.listings.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold px-8 py-4 rounded-lg transition text-lg">
            ➕ Krijo Shpalljen Tënde
        </a>
        @else
        <a href="{{ route('user.register') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-4 rounded-lg transition text-lg">
            📝 Regjistrohu Falas
        </a>
        @endif
    </div>
</div>
@endsection
