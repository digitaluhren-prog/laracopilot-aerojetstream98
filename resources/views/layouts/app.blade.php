<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shqiptarët në Gjermani')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #dc2626 0%, #7f1d1d 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-red-600 hover:text-red-700 transition">
                        🇦🇱 Shqiptarët në Gjermani
                    </a>
                    <div class="hidden md:flex space-x-6">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-red-600 font-bold transition">Ballina</a>
                        <a href="{{ route('search') }}" class="text-gray-700 hover:text-red-600 font-bold transition">Shpalljet</a>
                        <a href="{{ route('public.user-listings') }}" class="text-gray-700 hover:text-red-600 font-bold transition">Shpalljet e Përdoruesve</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @if(session('user_logged_in'))
                        <a href="{{ route('user.dashboard') }}" class="text-gray-700 hover:text-red-600 font-bold transition">
                            👤 {{ session('user_name') }}
                        </a>
                        <a href="{{ route('user.listings.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded transition">
                            📋 Shpalljet e Mia
                        </a>
                        <form action="{{ route('user.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-600 font-bold transition">
                                Dil
                            </button>
                        </form>
                    @else
                        <a href="{{ route('user.login') }}" class="text-gray-700 hover:text-red-600 font-bold transition">
                            Hyr
                        </a>
                        <a href="{{ route('user.register') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold px-4 py-2 rounded transition">
                            Regjistrohu
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    
    <main>
        @yield('content')
    </main>
    
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">🇦🇱 Shqiptarët në Gjermani</h3>
                <p class="text-gray-400">Platforma më e madhe për komunitetin shqiptar në Gjermani</p>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-4">Lidhje të Shpejta</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Ballina</a></li>
                    <li><a href="{{ route('search') }}" class="text-gray-400 hover:text-white transition">Shpalljet</a></li>
                    <li><a href="{{ route('public.user-listings') }}" class="text-gray-400 hover:text-white transition">Shpalljet e Përdoruesve</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-4">Për Përdoruesit</h4>
                <ul class="space-y-2">
                    @if(session('user_logged_in'))
                    <li><a href="{{ route('user.dashboard') }}" class="text-gray-400 hover:text-white transition">Dashboard</a></li>
                    <li><a href="{{ route('user.listings.index') }}" class="text-gray-400 hover:text-white transition">Shpalljet e Mia</a></li>
                    <li><a href="{{ route('user.listings.create') }}" class="text-gray-400 hover:text-white transition">Shto Shpallje</a></li>
                    @else
                    <li><a href="{{ route('user.login') }}" class="text-gray-400 hover:text-white transition">Hyr</a></li>
                    <li><a href="{{ route('user.register') }}" class="text-gray-400 hover:text-white transition">Regjistrohu</a></li>
                    @endif
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-4">Kontakt</h4>
                <ul class="space-y-2 text-gray-400">
                    <li>📧 info@shqiptaret-gjermani.de</li>
                    <li>📞 +49 123 456 789</li>
                    <li>📍 Berlin, Gjermani</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 py-6 text-center text-sm">
            <p>© {{ date('Y') }} Shqiptarët në Gjermani. Të gjitha të drejtat e rezervuara.</p>
            <p class="mt-2">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:underline text-red-400">LaraCopilot</a></p>
        </div>
    </footer>
</body>
</html>
