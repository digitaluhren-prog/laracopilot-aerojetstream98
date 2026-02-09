@extends('layouts.admin')

@section('title', 'Shpalljet - Admin Panel')
@section('page-title', 'Menaxhimi i Shpalljeve')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <p class="text-gray-600">Totali: <strong>{{ $listings->total() }}</strong> shpallje</p>
    </div>
    <a href="{{ route('admin.listings.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3 rounded-lg transition">
        ➕ Shto Shpallje të Re
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-4 text-left text-gray-700 font-bold">Titulli</th>
                <th class="px-6 py-4 text-left text-gray-700 font-bold">Kategoria</th>
                <th class="px-6 py-4 text-left text-gray-700 font-bold">Qyteti</th>
                <th class="px-6 py-4 text-center text-gray-700 font-bold">Shikime</th>
                <th class="px-6 py-4 text-center text-gray-700 font-bold">Statusi</th>
                <th class="px-6 py-4 text-right text-gray-700 font-bold">Veprime</th>
            </tr>
        </thead>
        <tbody>
            @forelse($listings as $listing)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-6 py-4">
                    <div>
                        <p class="font-bold text-gray-800">{{ Str::limit($listing->title, 50) }}</p>
                        @if($listing->featured)
                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded mt-1">⭐ I Zgjedhur</span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                        {{ $listing->category->name }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-600">{{ $listing->city }}</td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center">
                        <span class="mr-1">👁️</span>
                        <span class="font-bold text-gray-700">{{ number_format($listing->views) }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="px-3 py-1 rounded-full text-sm font-bold {{ $listing->active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $listing->active ? 'Aktiv' : 'Jo-aktiv' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('listing.show', $listing->id) }}" target="_blank" class="text-purple-600 hover:underline mr-3">Shiko</a>
                    <a href="{{ route('admin.listings.edit', $listing->id) }}" class="text-blue-600 hover:underline mr-3">Ndrysho</a>
                    <form action="{{ route('admin.listings.destroy', $listing->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Jeni i sigurt që dëshironi ta fshini këtë shpallje?')">
                            Fshi
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                    Nuk ka shpallje. <a href="{{ route('admin.listings.create') }}" class="text-blue-600 hover:underline">Shto shpalljen e parë</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $listings->links() }}
</div>
@endsection
