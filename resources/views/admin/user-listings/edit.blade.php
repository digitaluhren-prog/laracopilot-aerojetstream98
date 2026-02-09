@extends('layouts.admin')

@section('title', 'Ndrysho Shpalljen - Admin Panel')
@section('page-title', 'Ndrysho Shpalljen e Përdoruesit')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.user-listings.index') }}" class="text-blue-600 hover:underline">
        ← Kthehu te Lista
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg p-8">
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
        <p class="text-sm text-blue-800">
            <strong>Përdoruesi:</strong> {{ $listing->user->name }} ({{ $listing->user->email }})
        </p>
    </div>
    
    <form action="{{ route('admin.user-listings.update', $listing->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Titulli *</label>
                    <input type="text" name="title" value="{{ old('title', $listing->title) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Përshkrimi *</label>
                    <textarea name="description" rows="8" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $listing->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Kategoria *</label>
                        <select name="category_id" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 @error('category_id') border-red-500 @enderror">
                            <option value="">Zgjedh kategorinë...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $listing->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Qyteti *</label>
                        <input type="text" name="city" value="{{ old('city', $listing->city) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 @error('city') border-red-500 @enderror">
                        @error('city')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Adresa</label>
                    <input type="text" name="address" value="{{ old('address', $listing->address) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Telefoni</label>
                        <input type="text" name="phone" value="{{ old('phone', $listing->phone) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $listing->email) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Uebfaqja</label>
                        <input type="url" name="website" value="{{ old('website', $listing->website) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Çmimi (€)</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $listing->price) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="font-bold text-gray-800 mb-4">Statusi i Shpalljes</h3>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Statusi *</label>
                        <select name="status" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 @error('status') border-red-500 @enderror">
                            <option value="pending" {{ old('status', $listing->status) === 'pending' ? 'selected' : '' }}>⏳ Në pritje</option>
                            <option value="approved" {{ old('status', $listing->status) === 'approved' ? 'selected' : '' }}>✅ Miratuar</option>
                            <option value="rejected" {{ old('status', $listing->status) === 'rejected' ? 'selected' : '' }}>❌ Refuzuar</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Shënime për Përdoruesin</label>
                        <textarea name="admin_notes" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500" placeholder="Shto shënime që do t'i shfaqen përdoruesit...">{{ old('admin_notes', $listing->admin_notes) }}</textarea>
                    </div>
                </div>
                
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4">
                    <h4 class="font-bold text-yellow-900 mb-2">⚠️ Kujdes</h4>
                    <ul class="text-sm text-yellow-800 space-y-1">
                        <li>• Ndryshimet do të jenë të dukshme menjëherë</li>
                        <li>• Përdoruesi mund të shohë shënimet tuaja</li>
                        <li>• Statusin mund ta ndryshoni në çdo kohë</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
            <a href="{{ route('admin.user-listings.show', $listing->id) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-6 py-3 rounded-lg transition">
                Anulo
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-lg transition">
                💾 Ruaj Ndryshimet
            </button>
        </div>
    </form>
</div>
@endsection
