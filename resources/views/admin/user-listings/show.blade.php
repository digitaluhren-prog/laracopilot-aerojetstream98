@extends('layouts.admin')

@section('title', 'Shiko Shpalljen - Admin Panel')
@section('page-title', 'Detajet e Shpalljes')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.user-listings.index') }}" class="text-blue-600 hover:underline">
        ← Kthehu te Lista
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
    {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6">
                <span class="inline-block bg-blue-100 text-blue-800 text-sm px-4 py-2 rounded-full">{{ $listing->category->name }}</span>
                @if($listing->status === 'pending')
                    <span class="px-4 py-2 bg-orange-100 text-orange-800 rounded-full text-sm font-bold">⏳ Në pritje</span>
                @elseif($listing->status === 'approved')
                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-bold">✅ Miratuar</span>
                @else
                    <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-bold">❌ Refuzuar</span>
                @endif
            </div>
            
            <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ $listing->title }}</h1>
            
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-3">Përshkrimi</h2>
                <p class="text-gray-700 leading-relaxed">{{ $listing->description }}</p>
            </div>
            
            <div class="border-t pt-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Informacione të Detajuara</h2>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <span class="text-2xl mr-4">👤</span>
                        <div>
                            <p class="font-bold text-gray-800">Përdoruesi</p>
                            <p class="text-gray-600">{{ $listing->user->name }}</p>
                            <p class="text-gray-600 text-sm">{{ $listing->user->email }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-2xl mr-4">📁</span>
                        <div>
                            <p class="font-bold text-gray-800">Kategoria</p>
                            <p class="text-gray-600">{{ $listing->category->name }}</p>
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
                            <a href="{{ $listing->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $listing->website }}</a>
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
                    
                    <div class="flex items-start">
                        <span class="text-2xl mr-4">🔄</span>
                        <div>
                            <p class="font-bold text-gray-800">Përditësuar më</p>
                            <p class="text-gray-600">{{ $listing->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            @if($listing->admin_notes)
            <div class="mt-8 bg-yellow-50 border-l-4 border-yellow-500 p-6">
                <h3 class="font-bold text-yellow-900 mb-2">📝 Shënime nga Administratori:</h3>
                <p class="text-yellow-800">{{ $listing->admin_notes }}</p>
            </div>
            @endif
        </div>
    </div>
    
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow-lg p-6 sticky top-4">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Veprime të Shpejta</h3>
            
            @if($listing->status === 'pending')
            <form action="{{ route('admin.user-listings.approve', $listing->id) }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-3">
                    <label class="block text-gray-700 font-bold mb-2">Shënim (Opsionale)</label>
                    <textarea name="admin_notes" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="Shënim për përdoruesin..."></textarea>
                </div>
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition">
                    ✅ Aprovo Shpalljen
                </button>
            </form>
            
            <form action="{{ route('admin.user-listings.reject', $listing->id) }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-3">
                    <label class="block text-gray-700 font-bold mb-2">Arsyeja e Refuzimit</label>
                    <textarea name="admin_notes" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 text-sm" placeholder="Shpjego pse po refuzohet..."></textarea>
                </div>
                <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-lg transition">
                    ⏸️ Refuzo Shpalljen
                </button>
            </form>
            @elseif($listing->status === 'approved')
            <form action="{{ route('admin.user-listings.reject', $listing->id) }}" method="POST" class="mb-4">
                @csrf
                <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-lg transition">
                    ⏸️ Zhaktivizo
                </button>
            </form>
            @else
            <form action="{{ route('admin.user-listings.approve', $listing->id) }}" method="POST" class="mb-4">
                @csrf
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition">
                    ✅ Aprovo Tani
                </button>
            </form>
            @endif
            
            <a href="{{ route('admin.user-listings.edit', $listing->id) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg text-center transition mb-3">
                ✏️ Ndrysho
            </a>
            
            @if($listing->isApproved())
            <a href="{{ route('public.user-listing.show', $listing->id) }}" target="_blank" class="block w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-lg text-center transition mb-3">
                👁️ Shiko në Faqe
            </a>
            @endif
            
            <form action="{{ route('admin.user-listings.destroy', $listing->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition" onclick="return confirm('Jeni i sigurt që dëshironi ta fshini këtë shpallje?')">
                    🗑️ Fshi Shpalljen
                </button>
            </form>
        </div>
        
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mt-6">
            <h4 class="font-bold text-blue-900 mb-2">ℹ️ Informacion</h4>
            <ul class="text-sm text-blue-800 space-y-1">
                <li>• Shpalljet e miratuara shfaqen në faqen publike</li>
                <li>• Mund të shtoni shënime për përdoruesin</li>
                <li>• Përdoruesi njoftohet për statusin</li>
            </ul>
        </div>
    </div>
</div>
@endsection
