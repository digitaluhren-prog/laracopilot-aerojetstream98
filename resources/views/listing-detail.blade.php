@extends('layouts.app')

@section('title', $listing->title . ' - Shqiptarët në Gjermani')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <nav class="mb-6 text-gray-600">
        <a href="{{ route('home') }}" class="hover:text-red-600">Ballina</a> / 
        <a href="{{ route('search') }}" class="hover:text-red-600">Kërko</a> / 
        <span class="text-gray-800">{{ $listing->title }}</span>
    </nav>
    
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    @if($listing->featured)
                    <span class="inline-block gradient-bg text-white text-sm px-4 py-2 rounded-full">⭐ I Zgjedhur</span>
                    @endif
                    <span class="inline-block bg-blue-100 text-blue-800 text-sm px-4 py-2 rounded-full">{{ $listing->category->name }}</span>
                    <div class="flex items-center bg-gray-100 text-gray-700 text-sm px-4 py-2 rounded-full">
                        <span class="mr-2">👁️</span>
                        <span class="font-bold">{{ number_format($listing->views) }} shikime</span>
                    </div>
                    @if($listing->total_reviews > 0)
                    <div class="flex items-center bg-yellow-50 text-yellow-700 text-sm px-4 py-2 rounded-full">
                        <span class="mr-2">⭐</span>
                        <span class="font-bold">{{ number_format($listing->average_rating, 1) }}</span>
                        <span class="ml-1 text-gray-600">({{ $listing->total_reviews }} vlerësime)</span>
                    </div>
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
                            <span class="text-2xl mr-4">📍</span>
                            <div>
                                <p class="font-bold text-gray-800">Vendndodhja</p>
                                <p class="text-gray-600">{{ $listing->city }}</p>
                                @if($listing->address)
                                <p class="text-gray-600">{{ $listing->address }}</p>
                                @endif
                            </div>
                        </div>
                        
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
                            <span class="text-2xl mr-4">📊</span>
                            <div>
                                <p class="font-bold text-gray-800">Statistika</p>
                                <p class="text-gray-600">{{ number_format($listing->views) }} persona kanë parë këtë shpallje</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Reviews Section -->
            <div class="bg-white rounded-lg shadow-lg p-8 mt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Vlerësimet dhe Komentet</h2>
                
                @if($listing->approvedReviews->count() > 0)
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="text-5xl font-bold text-gray-800 mr-4">{{ number_format($listing->average_rating, 1) }}</div>
                        <div>
                            <div class="flex items-center mb-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="text-2xl {{ $i <= round($listing->average_rating) ? 'text-yellow-500' : 'text-gray-300' }}">⭐</span>
                                @endfor
                            </div>
                            <p class="text-gray-600">Bazuar në {{ $listing->total_reviews }} vlerësime</p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        @foreach($listing->approvedReviews as $review)
                        <div class="border-b pb-6 last:border-b-0">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $review->reviewer_name }}</p>
                                    <div class="flex items-center mt-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="text-lg {{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-300' }}">⭐</span>
                                        @endfor
                                    </div>
                                </div>
                                <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700">{{ $review->comment }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="bg-gray-50 rounded-lg p-6 mb-8 text-center">
                    <p class="text-gray-600">Kjo shpallje ende nuk ka vlerësime. Bëhuni i pari që e vlerëson!</p>
                </div>
                @endif
                
                <!-- Review Form -->
                <div class="border-t pt-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Shkruaj një Vlerësim</h3>
                    <form action="{{ route('review.store', $listing->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Vlerësimi Juaj *</label>
                            <div class="flex items-center space-x-2">
                                @for($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="{{ $i }}" required class="hidden peer" {{ old('rating') == $i ? 'checked' : '' }}>
                                    <span class="text-3xl peer-checked:text-yellow-500 text-gray-300 hover:text-yellow-400 transition">⭐</span>
                                </label>
                                @endfor
                            </div>
                            @error('rating')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Emri Juaj *</label>
                                <input type="text" name="reviewer_name" value="{{ old('reviewer_name', session('user_name')) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500 @error('reviewer_name') border-red-500 @enderror">
                                @error('reviewer_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Email Juaj *</label>
                                <input type="email" name="reviewer_email" value="{{ old('reviewer_email', session('user_email')) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500 @error('reviewer_email') border-red-500 @enderror">
                                @error('reviewer_email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Komenti Juaj *</label>
                            <textarea name="comment" rows="4" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500 @error('comment') border-red-500 @enderror" placeholder="Shkruani eksperiencën tuaj...">{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition">
                            📝 Dërgo Vlerësimin
                        </button>
                        <p class="text-sm text-gray-600 mt-2 text-center">Vlerësimi juaj do të shfaqet pas moderimit nga administratorët</p>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Kontakto Shpejt</h3>
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
                    <div class="flex items-center justify-center text-gray-600 mb-4">
                        <span class="text-3xl mr-3">👁️</span>
                        <div>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($listing->views) }}</p>
                            <p class="text-sm text-gray-600">Shikime Totale</p>
                        </div>
                    </div>
                    @if($listing->total_reviews > 0)
                    <div class="flex items-center justify-center text-gray-600">
                        <span class="text-3xl mr-3">⭐</span>
                        <div>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($listing->average_rating, 1) }}</p>
                            <p class="text-sm text-gray-600">{{ $listing->total_reviews }} Vlerësime</p>
                        </div>
                    </div>
                    @endif
                </div>
                
                @if($relatedListings->count() > 0)
                <div class="mt-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Shpallje të Ngjashme</h3>
                    <div class="space-y-4">
                        @foreach($relatedListings as $related)
                        <a href="{{ route('listing.show', $related->id) }}" class="block bg-gray-50 hover:bg-gray-100 rounded-lg p-4 transition">
                            <h4 class="font-bold text-gray-800 mb-1">{{ Str::limit($related->title, 50) }}</h4>
                            <div class="flex items-center justify-between text-sm text-gray-600">
                                <span>📍 {{ $related->city }}</span>
                                <span class="text-gray-400">👁️ {{ number_format($related->views) }}</span>
                            </div>
                            @if($related->total_reviews > 0)
                            <div class="flex items-center text-xs text-yellow-600 mt-1">
                                <span>⭐</span>
                                <span class="ml-1">{{ number_format($related->average_rating, 1) }}</span>
                            </div>
                            @endif
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
