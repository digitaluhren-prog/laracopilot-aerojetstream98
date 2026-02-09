@extends('layouts.app')

@section('title', 'Shpalljet e Mia - Shqiptarët në Gjermani')

@section('content')
<div class="gradient-bg text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl font-bold mb-2">Shpalljet e Mia</h1>
        <p class="text-red-100">Menaxho shpalljet e tua personale</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <div class="text-4xl mb-2">📋</div>
            <p class="text-3xl font-bold text-gray-800">{{ $listings->total() }}</p>
            <p class="text-gray-600">Totali i Shpalljeve</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <div class="text-4xl mb-2">✅</div>
            <p class="text-3xl font-bold text-green-600">{{ $approvedCount }}</p>
            <p class="text-gray-600">Të Miratuara</p>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <div class="text-4xl mb-2">⏳</div>
            <p class="text-3xl font-bold text-orange-600">{{ $pendingCount }}</p>
            <p class="text-gray-600">Në Pritje</p>
        </div>
    </div>
    
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Menaxho Shpalljet</h2>
        <a href="{{ route('user.listings.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3 rounded-lg transition">
            ➕ Shto Shpallje të Re
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
    
    @if($listings->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($listings as $listing)
        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-start mb-3">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">{{ $listing->category->name }}</span>
                    @if($listing->status === 'pending')
                        <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-xs font-bold">⏳ Në pritje</span>
                    @elseif($listing->status === 'approved')
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">✅ Miratuar</span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">❌ Refuzuar</span>
                    @endif
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $listing->title }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($listing->description, 100) }}</p>
                <div class="flex items-center text-gray-600 text-sm mb-2">
                    <span class="mr-2">📍</span>
                    <span>{{ $listing->city }}</span>
                </div>
                @if($listing->price)
                <div class="flex items-center text-gray-600 text-sm mb-4">
                    <span class="mr-2">💰</span>
                    <span class="font-bold">{{ number_format($listing->price, 2) }}€</span>
                </div>
                @endif
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('user.listings.show', $listing->id) }}" class="text-blue-600 hover:underline">Shiko</a>
                    @if($listing->status !== 'approved')
                    <a href="{{ route('user.listings.edit', $listing->id) }}" class="text-green-600 hover:underline">Ndrysho</a>
                    @endif
                    <form action="{{ route('user.listings.destroy', $listing->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Jeni i sigurt që dëshironi ta fshini këtë shpallje?')">
                            Fshi
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $listings->links() }}
    </div>
    @else
    <div class="bg-gray-50 rounded-lg p-12 text-center">
        <div class="text-6xl mb-4">📋</div>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Nuk keni shpallje ende</h3>
        <p class="text-gray-600 mb-6">Krijoni shpalljen tuaj të parë dhe ndani me komunitetin!</p>
        <a href="{{ route('user.listings.create') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-3 rounded-lg transition">
            ➕ Krijo Shpalljen e Parë
        </a>
    </div>
    @endif
</div>
@endsection
