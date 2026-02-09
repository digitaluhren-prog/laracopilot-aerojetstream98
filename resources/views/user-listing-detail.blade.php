@extends('layouts.app')

@section('title', $listing->title . ' - Shqiptarët në Gjermani')

@section('content')
<div class="gradient-bg text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <a href="{{ route('public.user-listings') }}" class="inline-block text-white hover:text-red-200 mb-4 font-bold">
            ← Kthehu tek Shpalljet
        </a>
        <h1 class="text-4xl font-bold mb-2">{{ $listing->title }}</h1>
        <div class="flex items-center space-x-4 text-red-100">
            <span>{{ $listing->category->icon }} {{ $listing->category->name }}</span>
            <span>•</span>
            <span>📍 {{ $listing->city }}</span>
            <span>•</span>
            <span>👤 {{ $listing->user->name }}</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            @if($listing->images && count($listing->images) > 0)
            <div class="mb-8">
                <div class="mb-4">
                    <img id="mainImage" src="{{ asset('storage/' . $listing->images[0]) }}" alt="{{ $listing->title }}" class="w-full h-96 object-cover rounded-lg shadow-lg">
                </div>
                @if(count($listing->images) > 1)
                <div class="grid grid-cols-5 gap-3">
                    @foreach($listing->images as $index => $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="Foto {{ $index + 1 }}" class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75 transition {{ $index === 0 ? 'ring-2 ring-purple-500' : '' }}" onclick="changeMainImage('{{ asset('storage/' . $image) }}', this)">
                    @endforeach
                </div>
                @endif
            </div>
            @else
            <div class="mb-8">
                <div class="w-full h-96 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg shadow-lg flex items-center justify-center">
                    <span class="text-9xl">{{ $listing->category->icon }}</span>
                </div>
            </div>
            @endif
            
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">📝 Përshkrimi</h2>
                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $listing->description }}</p>
            </div>
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded">
                <h3 class="font-bold text-blue-900 mb-2">ℹ️ Informacion i Rëndësishëm</h3>
                <ul class="text-blue-800 space-y-1 text-sm">
                    <li>• Kjo shpallje është publikuar nga një përdorues i komunitetit</li>
                    <li>• Kontaktoni drejtpërdrejt shitësin përmes informacionit të dhënë</li>
                    <li>• Verifikoni gjithmonë produktin/shërbimin para blerjes</li>
                    <li>• Raportoni nëse hasni probleme ose shpallje të papërshtatshme</li>
                </ul>
            </div>
        </div>
        
        <div class="lg:col-span-1">
            @if($listing->price)
            <div class="bg-green-50 border-2 border-green-500 rounded-lg p-6 mb-6 text-center">
                <p class="text-gray-700 font-bold mb-2">Çmimi</p>
                <p class="text-4xl font-bold text-green-600">{{ number_format($listing->price, 2) }}€</p>
            </div>
            @endif
            
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">📞 Informacioni i Kontaktit</h3>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <span class="text-2xl mr-3">👤</span>
                        <div>
                            <p class="text-sm text-gray-600">Publikuar nga</p>
                            <p class="font-bold text-gray-800">{{ $listing->user->name }}</p>
                        </div>
                    </div>
                    
                    @if($listing->phone)
                    <div class="flex items-start">
                        <span class="text-2xl mr-3">📞</span>
                        <div>
                            <p class="text-sm text-gray-600">Telefoni</p>
                            <a href="tel:{{ $listing->phone }}" class="font-bold text-blue-600 hover:underline">{{ $listing->phone }}</a>
                        </div>
                    </div>
                    @endif
                    
                    @if($listing->email)
                    <div class="flex items-start">
                        <span class="text-2xl mr-3">📧</span>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <a href="mailto:{{ $listing->email }}" class="font-bold text-blue-600 hover:underline break-all">{{ $listing->email }}</a>
                        </div>
                    </div>
                    @endif
                    
                    <div class="flex items-start">
                        <span class="text-2xl mr-3">📍</span>
                        <div>
                            <p class="text-sm text-gray-600">Vendndodhja</p>
                            <p class="font-bold text-gray-800">{{ $listing->city }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <span class="text-2xl mr-3">📅</span>
                        <div>
                            <p class="text-sm text-gray-600">Data e publikimit</p>
                            <p class="font-bold text-gray-800">{{ $listing->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-purple-50 border-l-4 border-purple-500 p-4 rounded">
                <p class="text-sm text-purple-800">💡 <strong>Këshillë:</strong> Kontaktoni shitësin për më shumë detaje ose për të organizuar një takim.</p>
            </div>
        </div>
    </div>
</div>

<script>
function changeMainImage(src, element) {
    document.getElementById('mainImage').src = src;
    
    document.querySelectorAll('.grid img').forEach(img => {
        img.classList.remove('ring-2', 'ring-purple-500');
    });
    
    element.classList.add('ring-2', 'ring-purple-500');
}
</script>
@endsection
