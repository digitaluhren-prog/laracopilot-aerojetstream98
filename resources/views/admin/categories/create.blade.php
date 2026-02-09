@extends('layouts.admin')

@section('title', 'Shto Kategori - Admin Panel')
@section('page-title', 'Shto Kategori të Re')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Emri i Kategorisë *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror" placeholder="p.sh. Mjek, Avokat, Shërbime...">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Përshkrimi</label>
                <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 @error('description') border-red-500 @enderror" placeholder="Shkruani një përshkrim të shkurtër për kategorinë...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.categories.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-6 py-3 rounded-lg transition">
                    Anulo
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3 rounded-lg transition">
                    ✅ Ruaj Kategorinë
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
