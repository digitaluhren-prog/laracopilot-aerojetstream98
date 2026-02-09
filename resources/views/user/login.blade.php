@extends('layouts.app')

@section('title', 'Hyr - Shqiptarët në Gjermani')

@section('content')
<div class="gradient-bg text-white py-12">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-2">Hyr në Llogari</h1>
        <p class="text-red-100">Qasje në llogarinë tuaj</p>
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
        
        <form action="{{ route('user.login') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500" placeholder="email@example.com">
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Fjalëkalimi</label>
                <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500" placeholder="••••••••">
            </div>
            
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition">
                🔑 Hyr
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-gray-600">Nuk keni llogari? <a href="{{ route('user.register') }}" class="text-red-600 hover:underline font-bold">Regjistrohu këtu</a></p>
        </div>
    </div>
</div>
@endsection
