@extends('layouts.app')

@section('title', $listing->title . ' - Shpalljet e Mia')

@section('content')
<div class="gradient-bg text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <nav class="mb-4 text-red-100">
            <a href="{{ route('user.dashboard') }}" class="hover:text-white">Dashboard</a> / 
            <a href="{{ route('user.listings.index') }}" class="hover:text-white">Shpalljet e Mia</a> / 
            <span class="text-white">{{ $listing->title }}</span>
        </nav>
        <h1 class="text-4xl font-bold">{{ $listing->title }}</h1>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-block bg-blue-100 text-blue-800 text-sm px-4 py-2 rounded-full">{{ $listing->category->name }}</span>
                    @if($listing->status === 'pending')
                        <span class="px-4 py-2 bg-orange-100 text-orange-800 rounded-full text-sm font-bold">⏳ Në pritje për moderim</span>
                    @elseif($listing->status === 'approved')
                        <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-bold">✅ Miratuar</span>
                    @else
                        <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-bold">❌ Refuzuar</span>
                    @endif
                </div>
                
                <div class="prose max-w-none mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Përshkrimi</h2>
                    <p class="text-gray-700 text-lg leading-relaxed">{{ $listing->description }}</p>
                </div>
                
                <div class="border-t pt-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Informacione</h2>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <span class="text-2xl mr-4">📍</span>
                            <div>
                                <p class="font-bold text-gray-800">Vendndodhja</p>
                                <p class="text-gray-600">{{ $listing->city }}</p>
                                @if($listing->address)
                                <p class="text-gray-600">{{ $listing->address }}</p>
                                @endif
                            </div>
                        </div>
                        
                        @if($listing->price)
                        <div class="flex items-start">
                            <span class="text-2xl mr-4">💰</span>
                            <div>
                                <p class="font-bold text-gray-800">Çmimi</p>
                                <p class="text-gray-600">{{ number_format($listing->price, 2) }}€</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($listing->phone)
                        <div class="flex items-start">
                            <span class="text-2xl mr-4">📞</span>
                            <div>
                                <p class="font-bold text-gray-800">Telefon</p>
                                <p class="text-gray-600">{{ $listing->phone }}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($listing->email)
                        <div class="flex items-start">
                            <span class="text-2xl mr-4">✉️</span>
                            <div>
                                <p class="font-bold text-gray-800">Email</p>
                                <p class="text-gray-600">{{ $listing->email }}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($listing->website)
                        <div class="flex items-start">
                            <span class="text-2xl mr-4">🌐</span>
                            <div>
                                <p class="font-bold text-gray-800">Uebfaqja</p>
                                <p class="text-gray-600">{{ $listing->website }}</p>
                            </div>
                        </div>
                        @endif
                        
                        <div class="flex items-start">
                            <span class="text-2xl mr-4">📅</span>
                            <div>
                                <p class="font-bold text-gray-800">Data e Krijimit</p>
                                <p class="text-gray-600">{{ $listing->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($listing->admin_notes)
                <div class="mt-8 bg-yellow-50 border-l-4 border-yellow-500 p-6">
                    <h3 class="font-bold text-yellow-900 mb-2">📝 Shënim nga Administratorët:</h3>
                    <p class="text-yellow-800">{{ $listing->admin_notes }}</p>
                </div>
                @endif
            </div>
        </div>
        
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Veprime</h3>
                <div class="space-y-3">
                    @if($listing->status !== 'approved')
                    <a href="{{ route('user.listings.edit', $listing->id) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg text-center transition">
                        ✏️ Ndrysho Shpalljen
                    </a>
                    @else
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-sm text-green-800">✅ Shpallja është miratuar. Kontaktoni administratorët për ndryshime.</p>
                    </div>
                    @endif
                    
                    <form action="{{ route('user.listings.destroy', $listing->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="block w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg text-center transition" onclick="return confirm('Jeni i sigurt që dëshironi ta fshini këtë shpallje?')">
                            🗑️ Fshi Shpalljen
                        </button>
                    </form>
                    
                    <a href="{{ route('user.listings.index') }}" class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 rounded-lg text-center transition">
                        ← Kthehu te Lista
                    </a>
                    
                    @if($listing->isApproved())
                    <a href="{{ route('public.user-listing.show', $listing->id) }}" target="_blank" class="block w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-lg text-center transition">
                        👁️ Shiko në Faqe
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
