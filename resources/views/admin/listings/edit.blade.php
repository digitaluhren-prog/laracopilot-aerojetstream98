@extends('layouts.admin')

@section('title', 'Ndrysho Shpalljen - Admin Panel')
@section('page-title', 'Ndrysho Shpalljen')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="{{ route('admin.listings.update', $listing->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-bold mb-2">Titulli i Shpalljes *</label>
                    <input type="text" name="title" value="{{ old('title', $listing->title) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-bold mb-2">Përshkrimi *</label>
                    <textarea name="description" rows="5" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $listing->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Kategoria *</label>
                    <select name="category_id" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500 @error('category_id') border-red-500 @enderror">
                        <option value="">Zgjedh kategorinë...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $listing->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Adresa</label>
                    <input type="text" name="address" value="{{ old('address', $listing->address) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Telefoni</label>
                    <input type="text" name="phone" value="{{ old('phone', $listing->phone) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $listing->email) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Uebfaqja</label>
                    <input type="url" name="website" value="{{ old('website', $listing->website) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-blue-500">
                </div>
                
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="active" value="1" {{ old('active', $listing->active) ? 'checked' : '' }} class="mr-2 w-5 h-5">
                            <span class="text-gray-700 font-bold">Aktive (Shfaqet në faqe)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="featured" value="1" {{ old('featured', $listing->featured) ? 'checked' : '' }} class="mr-2 w-5 h-5">
                            <span class="text-gray-700 font-bold">⭐ E Zgjedhur (Shfaqet në ballina)</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.listings.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-6 py-3 rounded-lg transition">
                    Anulo
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-lg transition">
                    💾 Përditëso Shpalljen
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
