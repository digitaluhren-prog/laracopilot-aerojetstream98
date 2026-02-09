@extends('layouts.app')

@section('title', $listing->title . ' - Shpalljet e Përdoruesve')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <nav class="mb-6 text-gray-600">
        <a href="{{ route('home') }}" class="hover:text-red-600">Ballina</a> / 
        <a href="{{ route('public.user-listings') }}" class="hover:text-red-600">Shpalljet e Përdoruesve</a> / 
        <span class="text-gray-800">{{ $listing->title }}</span>
    </nav>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    <span class="inline-block bg-blue-100 text-blue-800 text-sm px-4 py-2 rounded-full">{{ $listing->category->name }}</span>
                    @if($listing->price)
                    <span class="inline-block bg-green-100 text-green-800 text-sm px-4 py-2 rounded-full font-bold">💰 {{ number_format($listing->price, 2) }}€</span>
                    @endif
                </div>
                
                <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $listing->title }}</h1>
                
                <div class="prose max-w-none mb-8">
                    <p class="text-gray-700 text-lg leading-relaxed">{{ $listing->description }}</p>
                </div>
                
                <div class="border-t pt-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Informacione të Detajuara</h2>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <span class="text-2xl mr-4">👤</span>
                            <div>
                                <p class="font-bold text-gray-800">Publikuar nga</p>
                                <p class="text-gray-600">{{ $listing->user->name }}</p>
                            </div>
                        </div>
                        
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
                                <a href="tel:{{ $listing->phone }}" class="text-red-600 hover:underline">{{ $listing->phone }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @if($listing->email)
                        <div class="flex items-start">
                            <span class="text-2xl mr-4">✉️</span>
                            <div>
                                <p class="font-bold text-gray-800">Email</p>
                                <a href="mailto:{{ $listing->email }}" class="text-red-600 hover:underline">{{ $listing->email }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @if($listing->website)
                        <div class="flex items-start">
                            <span class="text-2xl mr-4">🌐</span>
                            <div>
                                <p class="font-bold text-gray-800">Uebfaqja</p>
                                <a href="{{ $listing->website }}" target="_blank" class="text-red-600 hover:underline">Vizito faqen</a>
                            </div>
                        </div>
                        @endif
                        
                        <div class="flex items-start">
                            <span class="text-2xl mr-4">📅</span>
                            <div>
                                <p class="font-bold text-gray-800">Publikuar më</p>
                                <p class="text-gray-600">{{ $listing->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Kontakto</h3>
                @if($listing->phone)
                <a href="tel:{{ $listing->phone }}" class="block w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg mb-3 text-center transition">
                    📞 Telefono Tani
                </a>
                @endif
                @if($listing->email)
                <a href="mailto:{{ $listing->email }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg mb-3 text-center transition">
                    ✉️ Dërgo Email
                </a>
                @endif
                @if($listing->website)
                <a href="{{ $listing->website }}" target="_blank" class="block w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-lg text-center transition">
                    🌐 Vizito Faqen
                </a>
                @endif
                
                <div class="mt-6 pt-6 border-t">
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-sm text-gray-600">Publikuar nga:</p>
                        <p class="font-bold text-gray-800 text-lg">{{ $listing->user->name }}</p>
                    </div>
                </div>
                
                @if($relatedListings->count() > 0)
                <div class="mt-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Shpallje të Ngjashme</h3>
                    <div class="space-y-4">
                        @foreach($relatedListings as $related)
                        <a href="{{ route('public.user-listing.show', $related->id) }}" class="block bg-gray-50 hover:bg-gray-100 rounded-lg p-4 transition">
                            <h4 class="font-bold text-gray-800 mb-1">{{ Str::limit($related->title, 50) }}</h4>
                            <div class="flex items-center justify-between text-sm text-gray-600">
                                <span>📍 {{ $related->city }}</span>
                                @if($related->price)
                                <span class="text-green-600 font-bold">{{ number_format($related->price, 2) }}€</span>
                                @endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
