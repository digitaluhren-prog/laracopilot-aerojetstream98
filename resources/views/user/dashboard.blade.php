@extends('layouts.app')

@section('title', 'Dashboard - Shqiptarët në Gjermani')

@section('content')
<div class="gradient-bg text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl font-bold mb-2">Mirë se erdhe, {{ session('user_name') }}!</h1>
        <p class="text-red-100">Menaxho llogarinë dhe shpalljet tuaja</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif
    
    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        <div class="lg:col-span-2">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @php
                    $myListingsCount = \App\Models\UserListing::where('user_id', session('user_id'))->count();
                    $approvedCount = \App\Models\UserListing::where('user_id', session('user_id'))->where('status', 'approved')->count();
                    $pendingCount = \App\Models\UserListing::where('user_id', session('user_id'))->where('status', 'pending')->count();
                @endphp
                
                <div class="bg-white rounded-lg shadow-lg p-8 text-center hover:shadow-xl transition">
                    <div class="text-5xl mb-4">📋</div>
                    <p class="text-4xl font-bold text-gray-800 mb-2">{{ $myListingsCount }}</p>
                    <p class="text-gray-600 font-bold">Shpalljet e Mia</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-8 text-center hover:shadow-xl transition">
                    <div class="text-5xl mb-4">✅</div>
                    <p class="text-4xl font-bold text-green-600 mb-2">{{ $approvedCount }}</p>
                    <p class="text-gray-600 font-bold">Të Miratuara</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-8 text-center hover:shadow-xl transition">
                    <div class="text-5xl mb-4">⏳</div>
                    <p class="text-4xl font-bold text-orange-600 mb-2">{{ $pendingCount }}</p>
                    <p class="text-gray-600 font-bold">Në Pritje</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('user.listings.index') }}" class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition duration-300 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">📋 Shpalljet e Mia</h3>
                            <p class="text-gray-600">Menaxho të gjitha shpalljet tuaja</p>
                        </div>
                        <span class="text-4xl">→</span>
                    </div>
                </a>
                
                <a href="{{ route('user.listings.create') }}" class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition duration-300 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">➕ Shto Shpallje të Re</h3>
                            <p class="text-gray-600">Krijo një shpallje të re</p>
                        </div>
                        <span class="text-4xl">→</span>
                    </div>
                </a>
                
                <a href="{{ route('public.user-listings') }}" class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition duration-300 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">🔍 Shfleto Shpalljet</h3>
                            <p class="text-gray-600">Shiko shpalljet e tjera</p>
                        </div>
                        <span class="text-4xl">→</span>
                    </div>
                </a>
                
                <a href="{{ route('home') }}" class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition duration-300 border-l-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-2">🏠 Kthehu në Ballina</h3>
                            <p class="text-gray-600">Shiko faqen kryesore</p>
                        </div>
                        <span class="text-4xl">→</span>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="lg:col-span-1">
            @php
                $user = \App\Models\User::find(session('user_id'));
            @endphp
            
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">👤 Profili Im</h3>
                    <button onclick="toggleEditProfile()" class="text-blue-600 hover:text-blue-700 font-bold" id="editProfileBtn">
                        ✏️ Ndrysho
                    </button>
                </div>
                
                <div id="profileView">
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-gradient-to-br from-red-500 to-red-700 rounded-full mx-auto flex items-center justify-center text-white text-4xl font-bold mb-3">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h4 class="text-xl font-bold text-gray-800">{{ $user->name }}</h4>
                        <p class="text-gray-600">{{ $user->email }}</p>
                    </div>
                    
                    <div class="space-y-3 border-t pt-4">
                        <div class="flex items-start">
                            <span class="text-xl mr-3">📧</span>
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="font-bold text-gray-800">{{ $user->email }}</p>
                            </div>
                        </div>
                        
                        @if($user->phone)
                        <div class="flex items-start">
                            <span class="text-xl mr-3">📞</span>
                            <div>
                                <p class="text-sm text-gray-600">Telefoni</p>
                                <p class="font-bold text-gray-800">{{ $user->phone }}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($user->city)
                        <div class="flex items-start">
                            <span class="text-xl mr-3">📍</span>
                            <div>
                                <p class="text-sm text-gray-600">Qyteti</p>
                                <p class="font-bold text-gray-800">{{ $user->city }}</p>
                            </div>
                        </div>
                        @endif
                        
                        <div class="flex items-start">
                            <span class="text-xl mr-3">📅</span>
                            <div>
                                <p class="text-sm text-gray-600">Anëtar që nga</p>
                                <p class="font-bold text-gray-800">{{ $user->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="profileEdit" style="display: none;">
                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Emri i Plotë</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-500">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-500">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Telefoni (Opsionale)</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-500" placeholder="+49 123 456789">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Qyteti (Opsionale)</label>
                            <input type="text" name="city" value="{{ old('city', $user->city) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-500" placeholder="Berlin, München...">
                        </div>
                        
                        <div class="mb-4 pb-4 border-b">
                            <p class="text-sm text-gray-600 italic">Lëreni bosh për të mbajtur fjalëkalimin aktual</p>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Fjalëkalimi i Ri (Opsionale)</label>
                            <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-500" placeholder="Minimum 8 karaktere">
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2">Konfirmo Fjalëkalimin</label>
                            <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-red-500" placeholder="Shkruaj përsëri">
                        </div>
                        
                        <div class="flex space-x-3">
                            <button type="button" onclick="toggleEditProfile()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 rounded-lg transition">
                                Anulo
                            </button>
                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition">
                                💾 Ruaj
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                <h4 class="font-bold text-blue-900 mb-2">ℹ️ Informacion</h4>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>• Shpalljet tuaja moderohhen nga administratorët</li>
                    <li>• Vetëm shpalljet e miratuara shfaqen publikisht</li>
                    <li>• Mbani të përditësuar informacionin e kontaktit</li>
                </ul>
            </div>
        </div>
    </div>
    
    @php
        $recentListings = \App\Models\UserListing::where('user_id', session('user_id'))
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    @endphp
    
    @if($recentListings->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Shpalljet e Fundit</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($recentListings as $listing)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">{{ $listing->category->name }}</span>
                        @if($listing->status === 'pending')
                            <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-xs font-bold">⏳</span>
                        @elseif($listing->status === 'approved')
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">✅</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">❌</span>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ Str::limit($listing->title, 40) }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($listing->description, 80) }}</p>
                    <a href="{{ route('user.listings.show', $listing->id) }}" class="text-blue-600 hover:underline font-bold">
                        Shiko Detajet →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
function toggleEditProfile() {
    const viewDiv = document.getElementById('profileView');
    const editDiv = document.getElementById('profileEdit');
    const btn = document.getElementById('editProfileBtn');
    
    if (viewDiv.style.display === 'none') {
        viewDiv.style.display = 'block';
        editDiv.style.display = 'none';
        btn.textContent = '✏️ Ndrysho';
    } else {
        viewDiv.style.display = 'none';
        editDiv.style.display = 'block';
        btn.textContent = '👁️ Shiko';
    }
}
</script>
@endsection
