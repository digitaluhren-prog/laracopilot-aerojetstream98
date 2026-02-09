@extends('layouts.app')

@section('title', 'Dashboard - Shqiptarët në Gjermani')

@section('content')
<div class="gradient-bg text-white py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-2">Mirë se erdhe, {{ session('user_name') }}! 👋</h1>
        <p class="text-base sm:text-lg text-red-100">Menaxho llogarinë dhe shpalljet tuaja nga këtu</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm sm:text-base">
        ✅ {{ session('success') }}
    </div>
    @endif
    
    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
        <ul class="list-disc list-inside text-sm sm:text-base">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 mb-8 sm:mb-12">
        <div class="lg:col-span-2 space-y-6 sm:space-y-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4 sm:mb-6 flex items-center">
                    <span class="bg-gradient-to-r from-red-500 to-red-600 text-white w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center mr-3 text-xl sm:text-2xl">🚀</span>
                    Veprime të Shpejta
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <a href="{{ route('user.listings.create') }}" class="group bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 sm:p-8 hover:shadow-2xl transition-all duration-300 text-white transform hover:scale-105">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-5xl sm:text-6xl">➕</div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-2">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold mb-2">Shto Shpallje të Re</h3>
                        <p class="text-green-100 text-sm sm:text-base">Publiko një shpallje të re tani</p>
                    </a>
                    
                    <a href="{{ route('user.listings.index') }}" class="group bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 sm:p-8 hover:shadow-2xl transition-all duration-300 text-white transform hover:scale-105">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-5xl sm:text-6xl">📋</div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-2">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold mb-2">Shpalljet e Mia</h3>
                        <p class="text-blue-100 text-sm sm:text-base">Menaxho shpalljet ekzistuese</p>
                    </a>
                    
                    <a href="{{ route('public.user-listings') }}" class="group bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 sm:p-8 hover:shadow-2xl transition-all duration-300 text-white transform hover:scale-105">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-5xl sm:text-6xl">🔍</div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-2">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold mb-2">Shfleto Shpalljet</h3>
                        <p class="text-purple-100 text-sm sm:text-base">Shiko të gjitha shpalljet</p>
                    </a>
                    
                    <a href="{{ route('home') }}" class="group bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-lg p-6 sm:p-8 hover:shadow-2xl transition-all duration-300 text-white transform hover:scale-105">
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-5xl sm:text-6xl">🏠</div>
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-2">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold mb-2">Ballina</h3>
                        <p class="text-orange-100 text-sm sm:text-base">Kthehu në faqen kryesore</p>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-1 space-y-6">
            @php
                $user = \App\Models\User::find(session('user_id'));
            @endphp
            
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-red-500 to-red-600 p-5 sm:p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg sm:text-xl font-bold text-white flex items-center">
                            <span class="mr-2">👤</span> Profili Im
                        </h3>
                        <button onclick="toggleEditProfile()" class="bg-white hover:bg-gray-100 text-red-600 font-bold px-3 sm:px-4 py-1 sm:py-2 rounded-lg text-xs sm:text-sm transition" id="editProfileBtn">
                            ✏️ Ndrysho
                        </button>
                    </div>
                </div>
                
                <div class="p-5 sm:p-6">
                    <div id="profileView">
                        <div class="text-center mb-6">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-red-500 to-red-700 rounded-full mx-auto flex items-center justify-center text-white text-3xl sm:text-4xl font-bold mb-3 shadow-lg ring-4 ring-red-100">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <h4 class="text-lg sm:text-xl font-bold text-gray-800">{{ $user->name }}</h4>
                            <p class="text-sm sm:text-base text-gray-600 break-all">{{ $user->email }}</p>
                        </div>
                        
                        <div class="space-y-4 border-t pt-4">
                            <div class="flex items-start bg-gray-50 rounded-lg p-3">
                                <span class="text-xl sm:text-2xl mr-3">📧</span>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm text-gray-600 font-semibold">Email</p>
                                    <p class="font-bold text-gray-800 text-sm sm:text-base break-all">{{ $user->email }}</p>
                                </div>
                            </div>
                            
                            @if($user->phone)
                            <div class="flex items-start bg-gray-50 rounded-lg p-3">
                                <span class="text-xl sm:text-2xl mr-3">📞</span>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm text-gray-600 font-semibold">Telefoni</p>
                                    <p class="font-bold text-gray-800 text-sm sm:text-base">{{ $user->phone }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($user->city)
                            <div class="flex items-start bg-gray-50 rounded-lg p-3">
                                <span class="text-xl sm:text-2xl mr-3">📍</span>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm text-gray-600 font-semibold">Qyteti</p>
                                    <p class="font-bold text-gray-800 text-sm sm:text-base">{{ $user->city }}</p>
                                </div>
                            </div>
                            @endif
                            
                            <div class="flex items-start bg-gray-50 rounded-lg p-3">
                                <span class="text-xl sm:text-2xl mr-3">📅</span>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm text-gray-600 font-semibold">Anëtar që nga</p>
                                    <p class="font-bold text-gray-800 text-sm sm:text-base">{{ $user->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="profileEdit" style="display: none;">
                        <form action="{{ route('user.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2 text-sm sm:text-base">Emri i Plotë</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-3 focus:outline-none focus:border-red-500 text-sm sm:text-base">
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2 text-sm sm:text-base">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-3 focus:outline-none focus:border-red-500 text-sm sm:text-base">
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2 text-sm sm:text-base">Telefoni (Opsionale)</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-3 focus:outline-none focus:border-red-500 text-sm sm:text-base" placeholder="+49 123 456789">
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2 text-sm sm:text-base">Qyteti (Opsionale)</label>
                                <input type="text" name="city" value="{{ old('city', $user->city) }}" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-3 focus:outline-none focus:border-red-500 text-sm sm:text-base" placeholder="Berlin, München...">
                            </div>
                            
                            <div class="mb-4 pb-4 border-b">
                                <p class="text-xs sm:text-sm text-gray-600 italic">Lëreni bosh për të mbajtur fjalëkalimin aktual</p>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 font-bold mb-2 text-sm sm:text-base">Fjalëkalimi i Ri (Opsionale)</label>
                                <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-3 focus:outline-none focus:border-red-500 text-sm sm:text-base" placeholder="Minimum 8 karaktere">
                            </div>
                            
                            <div class="mb-6">
                                <label class="block text-gray-700 font-bold mb-2 text-sm sm:text-base">Konfirmo Fjalëkalimin</label>
                                <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-3 focus:outline-none focus:border-red-500 text-sm sm:text-base" placeholder="Shkruaj përsëri">
                            </div>
                            
                            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                                <button type="button" onclick="toggleEditProfile()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 sm:py-3 rounded-lg transition text-sm sm:text-base">
                                    Anulo
                                </button>
                                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 sm:py-3 rounded-lg transition text-sm sm:text-base">
                                    💾 Ruaj
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-l-4 border-blue-500 p-4 sm:p-5 rounded-lg shadow-md">
                <h4 class="font-bold text-blue-900 mb-3 text-sm sm:text-base flex items-center">
                    <span class="mr-2">ℹ️</span> Informacion i Rëndësishëm
                </h4>
                <ul class="text-xs sm:text-sm text-blue-800 space-y-2">
                    <li class="flex items-start">
                        <span class="mr-2 mt-0.5">✓</span>
                        <span>Shpalljet moderohhen nga administratorët para publikimit</span>
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2 mt-0.5">✓</span>
                        <span>Vetëm shpalljet e miratuara shfaqen publikisht</span>
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2 mt-0.5">✓</span>
                        <span>Mbani të përditësuar informacionin tuaj kontaktues</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    @php
        $myListingsCount = \App\Models\UserListing::where('user_id', session('user_id'))->count();
        $approvedCount = \App\Models\UserListing::where('user_id', session('user_id'))->where('status', 'approved')->count();
        $pendingCount = \App\Models\UserListing::where('user_id', session('user_id'))->where('status', 'pending')->count();
    @endphp
    
    <div class="border-t-2 border-gray-200 pt-8 sm:pt-12">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 sm:mb-8 text-center">📊 Statistikat e Mia</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 sm:p-8 text-white text-center hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full w-16 h-16 sm:w-20 sm:h-20 flex items-center justify-center mx-auto mb-4 sm:mb-6">
                    <span class="text-4xl sm:text-5xl">📋</span>
                </div>
                <p class="text-4xl sm:text-5xl font-bold mb-2 sm:mb-3">{{ $myListingsCount }}</p>
                <p class="text-blue-100 font-semibold text-base sm:text-lg">Shpalljet e Mia</p>
                <p class="text-blue-200 text-xs sm:text-sm mt-2">Totali i shpalljeve të krijuara</p>
            </div>
            
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 sm:p-8 text-white text-center hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full w-16 h-16 sm:w-20 sm:h-20 flex items-center justify-center mx-auto mb-4 sm:mb-6">
                    <span class="text-4xl sm:text-5xl">✅</span>
                </div>
                <p class="text-4xl sm:text-5xl font-bold mb-2 sm:mb-3">{{ $approvedCount }}</p>
                <p class="text-green-100 font-semibold text-base sm:text-lg">Të Miratuara</p>
                <p class="text-green-200 text-xs sm:text-sm mt-2">Shpalljet aktive dhe publike</p>
            </div>
            
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-xl p-6 sm:p-8 text-white text-center hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full w-16 h-16 sm:w-20 sm:h-20 flex items-center justify-center mx-auto mb-4 sm:mb-6">
                    <span class="text-4xl sm:text-5xl">⏳</span>
                </div>
                <p class="text-4xl sm:text-5xl font-bold mb-2 sm:mb-3">{{ $pendingCount }}</p>
                <p class="text-orange-100 font-semibold text-base sm:text-lg">Në Pritje</p>
                <p class="text-orange-200 text-xs sm:text-sm mt-2">Në shqyrtim nga administratorët</p>
            </div>
        </div>
    </div>
</div>

<script>
function toggleEditProfile() {
    const viewDiv = document.getElementById('profileView');
    const editDiv = document.getElementById('profileEdit');
    const btn = document.getElementById('editProfileBtn');
    
    if (viewDiv.style.display === 'none') {
        viewDiv.style.display = 'block';
        editDiv.style.display = 'none';
        btn.innerHTML = '✏️ Ndrysho';
    } else {
        viewDiv.style.display = 'none';
        editDiv.style.display = 'block';
        btn.innerHTML = '👁️ Shiko';
    }
}
</script>
@endsection
