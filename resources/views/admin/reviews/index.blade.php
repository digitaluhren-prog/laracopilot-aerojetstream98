@extends('layouts.admin')

@section('title', 'Vlerësimet - Admin Panel')
@section('page-title', 'Menaxhimi i Vlerësimeve')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-gray-600">Totali: <strong>{{ $reviews->total() }}</strong> vlerësime</p>
            @if($pendingCount > 0)
            <p class="text-orange-600 font-bold mt-1">⚠️ {{ $pendingCount }} në pritje për moderim</p>
            @endif
        </div>
    </div>
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
                <th class="px-6 py-4 text-left text-gray-700 font-bold">Vlerësuesi</th>
                <th class="px-6 py-4 text-left text-gray-700 font-bold">Shpallja</th>
                <th class="px-6 py-4 text-center text-gray-700 font-bold">Vlerësimi</th>
                <th class="px-6 py-4 text-left text-gray-700 font-bold">Komenti</th>
                <th class="px-6 py-4 text-center text-gray-700 font-bold">Statusi</th>
                <th class="px-6 py-4 text-center text-gray-700 font-bold">Data</th>
                <th class="px-6 py-4 text-right text-gray-700 font-bold">Veprime</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $review)
            <tr class="border-t hover:bg-gray-50 {{ !$review->approved ? 'bg-yellow-50' : '' }}">
                <td class="px-6 py-4">
                    <div>
                        <p class="font-bold text-gray-800">{{ $review->reviewer_name }}</p>
                        <p class="text-sm text-gray-600">{{ $review->reviewer_email }}</p>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('listing.show', $review->listing->id) }}" target="_blank" class="text-blue-600 hover:underline">
                        {{ Str::limit($review->listing->title, 40) }}
                    </a>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $review->rating ? 'text-yellow-500' : 'text-gray-300' }}">⭐</span>
                        @endfor
                    </div>
                    <p class="text-sm text-gray-600 mt-1">{{ $review->rating }}/5</p>
                </td>
                <td class="px-6 py-4">
                    <p class="text-gray-700">{{ Str::limit($review->comment, 100) }}</p>
                </td>
                <td class="px-6 py-4 text-center">
                    @if($review->approved)
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-bold">✅ Miratuar</span>
                    @else
                        <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-bold">⏳ Në pritje</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-center text-sm text-gray-600">
                    {{ $review->created_at->format('d/m/Y H:i') }}
                </td>
                <td class="px-6 py-4 text-right">
                    @if(!$review->approved)
                    <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-green-600 hover:underline mr-3">
                            ✅ Aprovo
                        </button>
                    </form>
                    @else
                    <form action="{{ route('admin.reviews.reject', $review->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-orange-600 hover:underline mr-3">
                            ⏸️ Refuzo
                        </button>
                    </form>
                    @endif
                    <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Jeni i sigurt që dëshironi ta fshini këtë vlerësim?')">
                            🗑️ Fshi
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                    Nuk ka vlerësime ende.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $reviews->links() }}
</div>

<div class="mt-8 bg-blue-50 border-l-4 border-blue-500 p-6 rounded">
    <h3 class="font-bold text-blue-900 mb-2">ℹ️ Informacion për Moderimin</h3>
    <ul class="text-blue-800 space-y-1 text-sm">
        <li>• Vlerësimet e reja duhet të aprovohen para se të shfaqen në faqe</li>
        <li>• Mund të aprovoni ose refuzoni çdo vlerësim</li>
        <li>• Vlerësimet e aprovuara ndikojnë në vlerësimin mesatar të shpalljes</li>
        <li>• Mund të fshini vlerësime të papërshtatshme në çdo kohë</li>
    </ul>
</div>
@endsection
