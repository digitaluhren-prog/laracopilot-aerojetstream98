@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Ndrysho Kategorinë</h1>
        <p class="text-gray-600 mt-2">Përditëso informacionin e kategorisë</p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-3xl">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-3 text-lg">
                    <span class="flex items-center">
                        <span class="text-2xl mr-2">🏷️</span>
                        Emri i Kategorisë
                    </span>
                </label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" 
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition @error('name') border-red-500 @enderror" 
                    placeholder="Shembull: Restorant, Ndërtim, Shërbime Ligjore..." required>
                @error('name')
                    <span class="text-red-500 text-sm mt-1 flex items-center">
                        <span class="mr-1">⚠️</span>{{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-3 text-lg">
                    <span class="flex items-center">
                        <span class="text-2xl mr-2">😀</span>
                        Ikona (Emoji)
                    </span>
                </label>
                <div class="relative">
                    <input type="text" id="iconInput" name="icon" value="{{ old('icon', $category->icon) }}" 
                        class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-4xl text-center focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition @error('icon') border-red-500 @enderror" 
                        placeholder="👉 Zgjidh një emoji" required readonly style="cursor: pointer;" onclick="toggleIconPicker()">
                    @error('icon')
                        <span class="text-red-500 text-sm mt-1 flex items-center">
                            <span class="mr-1">⚠️</span>{{ $message }}
                        </span>
                    @enderror
                </div>
                
                <div id="iconPicker" class="mt-4 bg-gray-50 rounded-2xl p-6 border-2 border-gray-200" style="display: none;">
                    <div class="mb-4">
                        <h3 class="font-bold text-gray-700 mb-3 text-lg">Zgjidh një ikone profesionale:</h3>
                    </div>
                    <div class="grid grid-cols-6 sm:grid-cols-8 md:grid-cols-10 gap-3 max-h-80 overflow-y-auto">
                        <!-- Business & Services -->
                        <button type="button" onclick="selectIcon('🏢')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Business">🏢</button>
                        <button type="button" onclick="selectIcon('🏪')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Shop">🏪</button>
                        <button type="button" onclick="selectIcon('🏬')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Department Store">🏬</button>
                        <button type="button" onclick="selectIcon('🏭')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Factory">🏭</button>
                        <button type="button" onclick="selectIcon('🏗️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Construction">🏗️</button>
                        <button type="button" onclick="selectIcon('🏛️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Bank">🏛️</button>
                        <button type="button" onclick="selectIcon('🏥')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Hospital">🏥</button>
                        <button type="button" onclick="selectIcon('⚕️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Medical">⚕️</button>
                        <button type="button" onclick="selectIcon('💊')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Pharmacy">💊</button>
                        <button type="button" onclick="selectIcon('💉')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Clinic">💉</button>
                        
                        <!-- Food & Dining -->
                        <button type="button" onclick="selectIcon('🍽️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Restaurant">🍽️</button>
                        <button type="button" onclick="selectIcon('🍕')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Pizza">🍕</button>
                        <button type="button" onclick="selectIcon('🍔')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Fast Food">🍔</button>
                        <button type="button" onclick="selectIcon('☕')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Cafe">☕</button>
                        <button type="button" onclick="selectIcon('🍰')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Bakery">🍰</button>
                        <button type="button" onclick="selectIcon('🍷')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Bar">🍷</button>
                        
                        <!-- Transportation & Automotive -->
                        <button type="button" onclick="selectIcon('🚗')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Car Services">🚗</button>
                        <button type="button" onclick="selectIcon('🚕')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Taxi">🚕</button>
                        <button type="button" onclick="selectIcon('🚙')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="SUV">🚙</button>
                        <button type="button" onclick="selectIcon('🚚')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Delivery">🚚</button>
                        <button type="button" onclick="selectIcon('🔧')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Mechanic">🔧</button>
                        <button type="button" onclick="selectIcon('🛠️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Repair">🛠️</button>
                        
                        <!-- Professional Services -->
                        <button type="button" onclick="selectIcon('⚖️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Legal">⚖️</button>
                        <button type="button" onclick="selectIcon('💼')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Consulting">💼</button>
                        <button type="button" onclick="selectIcon('📊')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Accounting">📊</button>
                        <button type="button" onclick="selectIcon('💰')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Finance">💰</button>
                        <button type="button" onclick="selectIcon('📝')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Documentation">📝</button>
                        <button type="button" onclick="selectIcon('📋')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Administration">📋</button>
                        
                        <!-- Real Estate & Home -->
                        <button type="button" onclick="selectIcon('🏠')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Real Estate">🏠</button>
                        <button type="button" onclick="selectIcon('🏡')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="House">🏡</button>
                        <button type="button" onclick="selectIcon('🏘️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Housing">🏘️</button>
                        <button type="button" onclick="selectIcon('🔑')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Keys">🔑</button>
                        <button type="button" onclick="selectIcon('🛋️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Furniture">🛋️</button>
                        <button type="button" onclick="selectIcon('🪴')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Garden">🪴</button>
                        
                        <!-- Education & Learning -->
                        <button type="button" onclick="selectIcon('📚')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Education">📚</button>
                        <button type="button" onclick="selectIcon('🎓')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="University">🎓</button>
                        <button type="button" onclick="selectIcon('✏️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Writing">✏️</button>
                        <button type="button" onclick="selectIcon('📖')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Reading">📖</button>
                        <button type="button" onclick="selectIcon('🖊️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Pen">🖊️</button>
                        
                        <!-- Technology & Digital -->
                        <button type="button" onclick="selectIcon('💻')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Computer">💻</button>
                        <button type="button" onclick="selectIcon('📱')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Mobile">📱</button>
                        <button type="button" onclick="selectIcon('⌨️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Keyboard">⌨️</button>
                        <button type="button" onclick="selectIcon('🖥️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Desktop">🖥️</button>
                        <button type="button" onclick="selectIcon('🖨️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Printer">🖨️</button>
                        <button type="button" onclick="selectIcon('📷')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Photography">📷</button>
                        
                        <!-- Beauty & Fashion -->
                        <button type="button" onclick="selectIcon('💄')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Cosmetics">💄</button>
                        <button type="button" onclick="selectIcon('💅')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Nails">💅</button>
                        <button type="button" onclick="selectIcon('💇')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Haircut">💇</button>
                        <button type="button" onclick="selectIcon('👗')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Fashion">👗</button>
                        <button type="button" onclick="selectIcon('👔')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Clothing">👔</button>
                        <button type="button" onclick="selectIcon('👠')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Shoes">👠</button>
                        
                        <!-- Sports & Fitness -->
                        <button type="button" onclick="selectIcon('⚽')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Sports">⚽</button>
                        <button type="button" onclick="selectIcon('🏋️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Gym">🏋️</button>
                        <button type="button" onclick="selectIcon('🤸')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Fitness">🤸</button>
                        <button type="button" onclick="selectIcon('🧘')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Yoga">🧘</button>
                        <button type="button" onclick="selectIcon('🏊')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Swimming">🏊</button>
                        
                        <!-- Entertainment & Arts -->
                        <button type="button" onclick="selectIcon('🎭')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Theater">🎭</button>
                        <button type="button" onclick="selectIcon('🎬')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Cinema">🎬</button>
                        <button type="button" onclick="selectIcon('🎨')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Art">🎨</button>
                        <button type="button" onclick="selectIcon('🎵')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Music">🎵</button>
                        <button type="button" onclick="selectIcon('🎸')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Guitar">🎸</button>
                        <button type="button" onclick="selectIcon('🎤')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Microphone">🎤</button>
                        
                        <!-- Travel & Tourism -->
                        <button type="button" onclick="selectIcon('✈️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Travel">✈️</button>
                        <button type="button" onclick="selectIcon('🧳')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Luggage">🧳</button>
                        <button type="button" onclick="selectIcon('🗺️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Map">🗺️</button>
                        <button type="button" onclick="selectIcon('🏨')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Hotel">🏨</button>
                        <button type="button" onclick="selectIcon('🏖️')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Beach">🏖️</button>
                        
                        <!-- Miscellaneous -->
                        <button type="button" onclick="selectIcon('📦')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Package">📦</button>
                        <button type="button" onclick="selectIcon('📮')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Mailbox">📮</button>
                        <button type="button" onclick="selectIcon('🎁')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Gift">🎁</button>
                        <button type="button" onclick="selectIcon('🎉')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Party">🎉</button>
                        <button type="button" onclick="selectIcon('🔔')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Notification">🔔</button>
                        <button type="button" onclick="selectIcon('📞')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Phone">📞</button>
                        <button type="button" onclick="selectIcon('📧')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Email">📧</button>
                        <button type="button" onclick="selectIcon('🌐')" class="icon-btn bg-white hover:bg-blue-100 border-2 border-gray-200 hover:border-blue-500 rounded-xl p-4 text-4xl transition-all duration-200 transform hover:scale-110" title="Web">🌐</button>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-3 text-lg">
                    <span class="flex items-center">
                        <span class="text-2xl mr-2">📄</span>
                        Përshkrimi
                    </span>
                </label>
                <textarea name="description" rows="4" 
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 text-lg focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition @error('description') border-red-500 @enderror" 
                    placeholder="Shkruaj një përshkrim të shkurtër për këtë kategori...">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm mt-1 flex items-center">
                        <span class="mr-1">⚠️</span>{{ $message }}
                    </span>
                @enderror
            </div>

            <div class="mb-8">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="active" value="1" {{ old('active', $category->active) ? 'checked' : '' }} 
                        class="w-6 h-6 text-blue-600 border-2 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                    <span class="ml-3 text-gray-700 font-bold text-lg">
                        <span class="flex items-center">
                            <span class="text-2xl mr-2">✅</span>
                            Kategori Aktive (Shfaqet në faqe)
                        </span>
                    </span>
                </label>
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('admin.categories.index') }}" 
                    class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-4 rounded-xl transition text-center text-lg">
                    Anulo
                </a>
                <button type="submit" 
                    class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 rounded-xl transition transform hover:scale-105 text-lg shadow-lg">
                    💾 Ruaj Ndryshimet
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleIconPicker() {
    const picker = document.getElementById('iconPicker');
    picker.style.display = picker.style.display === 'none' ? 'block' : 'none';
}

function selectIcon(icon) {
    document.getElementById('iconInput').value = icon;
    document.getElementById('iconPicker').style.display = 'none';
    
    // Remove selected class from all buttons
    document.querySelectorAll('.icon-btn').forEach(btn => {
        btn.classList.remove('bg-blue-500', 'border-blue-600', 'text-white');
        btn.classList.add('bg-white', 'hover:bg-blue-100');
    });
    
    // Add selected class to clicked button
    event.target.classList.remove('bg-white', 'hover:bg-blue-100');
    event.target.classList.add('bg-blue-500', 'border-blue-600', 'text-white');
}
</script>
@endsection
