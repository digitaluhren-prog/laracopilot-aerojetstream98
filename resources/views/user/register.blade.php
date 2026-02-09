@extends('layouts.app')

@section('title', 'Regjistrohu - Shqiptarët në Gjermani')

@section('content')
<div class="gradient-bg text-white py-12">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-2">Regjistrohu</h1>
        <p class="text-red-100">Krijo llogarinë tënde falas</p>
    </div>
</div>

<div class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white rounded-lg shadow-lg p-8">
        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <form action="{{ route('user.register') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Emri i Plotë *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500" placeholder="Emri dhe Mbiemri">
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500" placeholder="email@example.com">
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Fjalëkalimi *</label>
                <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500" placeholder="Minimum 8 karaktere">
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Konfirmo Fjalëkalimin *</label>
                <input type="password" name="password_confirmation" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500" placeholder="Shkruaj përsëri fjalëkalimin">
            </div>
            
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition">
                📝 Regjistrohu
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-gray-600">Keni llogari? <a href="{{ route('user.login') }}" class="text-red-600 hover:underline font-bold">Hyni këtu</a></p>
        </div>
        
        <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
            <p class="text-sm text-blue-800">ℹ️ Duke u regjistruar, pranoni kushtet e përdorimit dhe politikën e privatësisë.</p>
        </div>
    </div>
</div>
@endsection
