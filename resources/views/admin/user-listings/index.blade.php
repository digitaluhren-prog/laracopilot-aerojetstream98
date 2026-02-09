@extends('layouts.admin')

@section('title', 'Shpalljet e Përdoruesve - Admin Panel')
@section('page-title', 'Shpalljet e Përdoruesve')

@section('content')
<div class="mb-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-orange-100 rounded-lg p-4">
            <p class="text-orange-600 font-bold">⏳ Në Pritje</p>
            <p class="text-3xl font-bold text-orange-700">{{ $pendingCount }}</p>
        </div>
        <div class="bg-green-100 rounded-lg p-4">
            <p class="text-green-600 font-bold">✅ Të Miratuara</p>
            <p class="text-3xl font-bold text-green-700">{{ $approvedCount }}</p>
        </div>
        <div class="bg-red-100 rounded-lg p-4">
            <p class="text-red-600 font-bold">❌ Të Refuzuara</p>
            <p class="text-3xl font-bold text-red-700">{{ $rejectedCount }}</p>
        </div>
    </div>
    <p class="text-gray-600">Totali: <strong>{{ $listings->total() }}</strong> shpallje</p>
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
                <th class="px-6 py-4 text-left text-gray-700 font-bold">Përdoruesi</th>
                <th class="px-6 py-4 text-left text-gray-700 font-bold">Titulli</th>
                <th class="px-6 py-4 text-left text-gray-700 font-bold">Kategoria</th>
                <th class="px-6 py-4 text-left text-gray-700 font-bold">Qyteti</th>
                <th class="px-6 py-4 text-center text-gray-700 font-bold">Statusi</th>
                <th class="px-6 py-4 text-center text-gray-700 font-bold">Data</th>
                <th class="px-6 py-4 text-right text-gray-700 font-bold">Veprime</th>
            </tr>
        </thead>
        <tbody>
            @forelse($listings as $listing)
            <tr class="border-t hover:bg-gray-50 {{ $listing->status === 'pending' ? 'bg-orange-50' : '' }}">
                <td class="px-6 py-4">
                    <div>
                        <p class="font-bold text-gray-800">{{ $listing->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $listing->user->email }}</p>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <p class="font-bold text-gray-800">{{ Str::limit($listing->title, 40) }}</p>
                    @if($listing->price)
                    <p class="text-sm text-gray-600">💰 {{ number_format($listing->price, 2) }}€</p>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">{{ $listing->category->name }}</span>
                </td>
                <td class="px-6 py-4 text-gray-600">{{ $listing->city }}</td>
                <td class="px-6 py-4 text-center">
                    @if($listing->status === 'pending')
                        <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-bold">⏳ Në pritje</span>
                    @elseif($listing->status === 'approved')
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-bold">✅ Miratuar</span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-bold">❌ Refuzuar</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-center text-sm text-gray-600">
                    {{ $listing->created_at->format('d/m/Y') }}
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.user-listings.show', $listing->id) }}" class="text-blue-600 hover:underline mr-3">Shiko</a>
                    @if($listing->status === 'pending')
                    <form action="{{ route('admin.user-listings.approve', $listing->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-green-600 hover:underline mr-3">✅ Aprovo</button>
                    </form>
                    <form action="{{ route('admin.user-listings.reject', $listing->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-orange-600 hover:underline mr-3">⏸️ Refuzo</button>
                    </form>
                    @endif
                    <a href="{{ route('admin.user-listings.edit', $listing->id) }}" class="text-purple-600 hover:underline mr-3">Ndrysho</a>
                    <form action="{{ route('admin.user-listings.destroy', $listing->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Jeni i sigurt?')">
                            Fshi
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                    Nuk ka shpallje ende.
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
