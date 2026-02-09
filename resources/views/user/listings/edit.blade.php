@extends('layouts.app')

@section('title', 'Ndrysho Shpalljen - Shqiptarët në Gjermani')

@section('content')
<div class="gradient-bg text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-4xl font-bold mb-2">✏️ Ndrysho Shpalljen</h1>
        <p class="text-red-100">Përditëso informacionin e shpalljes</p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 py-12">
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
        
        <form action="{{ route('user.listings.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Titulli i Shpalljes *</label>
                <input type="text" name="title" value="{{ old('title', $listing->title) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500">
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Kategoria *</label>
                <select name="category_id" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500">
                    <option value="">Zgjidh kategorinë</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $listing->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->icon }} {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Përshkrimi *</label>
                <textarea name="description" rows="6" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500">{{ old('description', $listing->description) }}</textarea>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Qyteti *</label>
                    <input type="text" name="city" value="{{ old('city', $listing->city) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Çmimi (Opsionale)</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $listing->price) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500">
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Telefoni (Opsionale)</label>
                    <input type="text" name="phone" value="{{ old('phone', $listing->phone) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Email (Opsionale)</label>
                    <input type="email" name="email" value="{{ old('email', $listing->email) }}" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-red-500">
                </div>
            </div>
            
            @if($listing->images && count($listing->images) > 0)
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Fotot Aktuale</label>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-4">
                    @foreach($listing->images as $index => $image)
                    <div class="relative group">
                        <img src="{{ asset('storage/' . $image) }}" class="w-full h-32 object-cover rounded-lg">
                        <div class="absolute top-2 right-2 bg-blue-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">{{ $index + 1 }}</div>
                        <label class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition cursor-pointer rounded-lg">
                            <input type="checkbox" name="delete_images[]" value="{{ $index }}" class="mr-2">
                            <span class="text-white text-sm font-bold">🗑️ Fshi</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                <p class="text-sm text-gray-600">Kliko mbi fotot për t'i fshirë</p>
            </div>
            @endif
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Shto Foto të Reja (Opsionale)</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <input type="file" name="images[]" id="imageInput" multiple accept="image/jpeg,image/png,image/webp" class="hidden" onchange="previewImages(event)">
                    <label for="imageInput" class="cursor-pointer">
                        <div class="text-5xl mb-3">📷</div>
                        <p class="text-gray-700 font-bold mb-2">Kliko për të zgjedhur foto</p>
                        <p class="text-gray-600 text-sm">Maksimumi 5 foto totale, JPG/PNG/WEBP, maksimum 1.5MB secila</p>
                    </label>
                </div>
                <div id="imagePreview" class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4"></div>
            </div>
            
            <div class="bg-orange-50 border-l-4 border-orange-500 p-4 rounded mb-6">
                <p class="text-sm text-orange-800">⚠️ <strong>Vërejtje:</strong> Ndryshimet do të dërgohen për shqyrtim nga administratorët. Statusi i shpalljes mund të kthehet në "Në Pritje".</p>
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="{{ route('user.listings.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-6 py-3 rounded-lg transition">
                    Anulo
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-lg transition">
                    💾 Ruaj Ndryshimet
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImages(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('imagePreview');
    previewContainer.innerHTML = '';
    
    const currentImageCount = {{ $listing->images ? count($listing->images) : 0 }};
    const deleteCount = document.querySelectorAll('input[name="delete_images[]"]:checked').length;
    const remainingSlots = 5 - (currentImageCount - deleteCount);
    
    if (files.length > remainingSlots) {
        alert(`Mund të ngarkoni maksimum ${remainingSlots} foto të reja`);
        event.target.value = '';
        return;
    }
    
    Array.from(files).forEach((file, index) => {
        if (file.size > 1.5 * 1024 * 1024) {
            alert(`Fotoja ${file.name} është më e madhe se 1.5MB`);
            event.target.value = '';
            previewContainer.innerHTML = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'relative';
            div.innerHTML = `
                <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg">
                <div class="absolute top-2 right-2 bg-green-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">E re</div>
            `;
            previewContainer.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}
</script>
@endsection
