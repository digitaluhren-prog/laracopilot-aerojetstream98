<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <aside class="w-64 gradient-bg text-white">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
                <p class="text-sm text-gray-400 mt-1">{{ session('admin_user') }}</p>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 hover:bg-slate-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700 border-l-4 border-red-500' : '' }}">
                    <span class="text-lg">📊 Dashboard</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="block px-6 py-3 hover:bg-slate-700 transition {{ request()->routeIs('admin.categories.*') ? 'bg-slate-700 border-l-4 border-red-500' : '' }}">
                    <span class="text-lg">📁 Kategoritë</span>
                </a>
                <a href="{{ route('admin.listings.index') }}" class="block px-6 py-3 hover:bg-slate-700 transition {{ request()->routeIs('admin.listings.*') ? 'bg-slate-700 border-l-4 border-red-500' : '' }}">
                    <span class="text-lg">📋 Shpalljet</span>
                </a>
                <a href="{{ route('admin.user-listings.index') }}" class="block px-6 py-3 hover:bg-slate-700 transition {{ request()->routeIs('admin.user-listings.*') ? 'bg-slate-700 border-l-4 border-red-500' : '' }}">
                    <span class="text-lg">👥 Shpalljet e Përdoruesve</span>
                    @php
                        $pendingUserListings = \App\Models\UserListing::where('status', 'pending')->count();
                    @endphp
                    @if($pendingUserListings > 0)
                        <span class="ml-2 bg-orange-500 text-white text-xs px-2 py-1 rounded-full">{{ $pendingUserListings }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.reviews.index') }}" class="block px-6 py-3 hover:bg-slate-700 transition {{ request()->routeIs('admin.reviews.*') ? 'bg-slate-700 border-l-4 border-red-500' : '' }}">
                    <span class="text-lg">⭐ Vlerësimet</span>
                    @php
                        $pendingReviews = \App\Models\Review::where('approved', false)->count();
                    @endphp
                    @if($pendingReviews > 0)
                        <span class="ml-2 bg-orange-500 text-white text-xs px-2 py-1 rounded-full">{{ $pendingReviews }}</span>
                    @endif
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="mt-6">
                    @csrf
                    <button type="submit" class="block w-full text-left px-6 py-3 hover:bg-slate-700 transition text-red-400">
                        <span class="text-lg">🚪 Dil</span>
                    </button>
                </form>
            </nav>
        </aside>
        
        <main class="flex-1 overflow-y-auto">
            <header class="bg-white shadow-sm">
                <div class="px-8 py-4">
                    <h2 class="text-2xl font-bold text-gray-800">@yield('page-title')</h2>
                </div>
            </header>
            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
