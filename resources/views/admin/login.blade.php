<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-lg shadow-2xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Admin Panel</h1>
                <p class="text-gray-600 mt-2">Hyr në panelin e administratorit</p>
            </div>
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <p class="text-sm font-bold text-blue-900 mb-2">Test Credentials:</p>
                <p class="text-sm text-blue-800">📧 admin@albanian-listings.de</p>
                <p class="text-sm text-blue-800">🔑 admin123</p>
                <p class="text-sm text-blue-800 mt-2">📧 moderator@albanian-listings.de</p>
                <p class="text-sm text-blue-800">🔑 moderator123</p>
            </div>
            
            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
            @endif
            
            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-slate-700" placeholder="admin@albanian-listings.de">
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Fjalëkalimi</label>
                    <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-slate-700" placeholder="••••••••">
                </div>
                
                <button type="submit" class="w-full gradient-bg text-white font-bold py-3 rounded-lg hover:opacity-90 transition duration-300">
                    Hyr në Panel
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-slate-700 hover:underline">← Kthehu në faqen kryesore</a>
            </div>
        </div>
    </div>
</body>
</html>
