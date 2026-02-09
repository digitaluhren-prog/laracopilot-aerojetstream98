<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserListing;
use App\Models\User;
use App\Models\Category;

class UserListingSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        
        if ($users->isEmpty()) {
            $users = User::factory()->count(5)->create();
        }
        
        $cities = ['Berlin', 'München', 'Frankfurt', 'Hamburg', 'Köln', 'Stuttgart', 'Düsseldorf', 'Dortmund'];
        
        $sampleListings = [
            [
                'title' => 'Ofroj Shërbime Pastrimi në Shtëpi',
                'description' => 'Ofroj shërbime profesionale pastrimi për shtëpi dhe apartamente. Kam përvojë 5 vjeçare. Çmime të arsyeshme dhe shërbim cilësor. Kontaktoni për më shumë detaje.',
                'category' => 'Pastrimi',
                'price' => 15.00
            ],
            [
                'title' => 'Ndihma për Përkthime Gjermanisht-Shqip',
                'description' => 'Ofroj ndihmë për përkthime gjermanisht-shqip për dokumente zyrtare, letra, formulare dhe më shumë. Shërbim i shpejtë dhe i besueshëm.',
                'category' => 'Shërbime',
                'price' => 20.00
            ],
            [
                'title' => 'Shitet Mobilje Shtëpie të Përdorura',
                'description' => 'Shiten mobilje të përdorura në gjendje shumë të mirë: divan, tavolina kafeje, karriget, dhe dollapë. Çmime shumë të mira. Mundësi transporti.',
                'category' => 'Dyqane',
                'price' => 150.00
            ],
            [
                'title' => 'Mësim Privat Gjuhe Gjermane',
                'description' => 'Jap mësim privat gjuhe gjermane për të gjitha nivelet. Kam diplomë në gjermanisht dhe përvojë 8 vjeçare. Orë fleksibël dhe program individual.',
                'category' => 'Shërbime',
                'price' => 25.00
            ],
            [
                'title' => 'Ndihma me Deklarimin e Taksave',
                'description' => 'Ofroj ndihmë profesionale për deklarimin e taksave (Steuererklärung). Shpjegime në shqip dhe asistencë e plotë. Çmime konkurruese.',
                'category' => 'Shërbime',
                'price' => 50.00
            ],
            [
                'title' => 'Shërbim Riparimi Elektrikë',
                'description' => 'Ofroj shërbime riparimi elektrikë për shtëpi. Instalime, riparime, dhe mirëmbajtje. Licencuar dhe i siguruar. Thirrni për ofertë falas.',
                'category' => 'Ndërtim',
                'price' => null
            ],
            [
                'title' => 'Transport Mallrash në Kosovë/Shqipëri',
                'description' => 'Ofroj shërbim transporti mallrash nga Gjermania në Kosovë dhe Shqipëri. Çmime të përballueshme dhe shërbim i besueshëm. Transportojmë çdo lloj pakete.',
                'category' => 'Transport',
                'price' => null
            ],
            [
                'title' => 'Kujdestare Fëmijësh me Përvojë',
                'description' => 'Jam nënë me përvojë dhe ofroj shërbime kujdesi për fëmijë. E besueshme, e dashur me fëmijët. Referenca të disponueshme. Orar fleksibël.',
                'category' => 'Shërbime',
                'price' => 12.00
            ],
            [
                'title' => 'Ndihmë për Aplikime Pune',
                'description' => 'Ndihmoj me përgatitjen e aplikimeve për punë (Bewerbung), shkruarje CV, letër motivimi. Këshilla për intervista. Rezultate të dëshmuara.',
                'category' => 'Shërbime',
                'price' => 30.00
            ],
            [
                'title' => 'Shërbim Bojaxhiu me Përvojë',
                'description' => 'Ofroj shërbime profesionale bojaxhiu për shtëpi dhe apartamente. Punë e pastër dhe cilësore. Çmime të mira. Kontaktoni për ofertë.',
                'category' => 'Ndërtim',
                'price' => null
            ]
        ];
        
        foreach ($sampleListings as $listingData) {
            $category = Category::where('name', $listingData['category'])->first();
            
            if ($category) {
                UserListing::create([
                    'user_id' => $users->random()->id,
                    'category_id' => $category->id,
                    'title' => $listingData['title'],
                    'description' => $listingData['description'],
                    'city' => $cities[array_rand($cities)],
                    'address' => null,
                    'phone' => '+49 ' . rand(100, 999) . ' ' . rand(1000000, 9999999),
                    'email' => strtolower(str_replace(' ', '', explode(' ', $listingData['title'])[0])) . rand(1, 99) . '@email.com',
                    'website' => null,
                    'price' => $listingData['price'],
                    'status' => ['pending', 'approved', 'approved', 'approved'][array_rand(['pending', 'approved', 'approved', 'approved'])],
                    'admin_notes' => null
                ]);
            }
        }
        
        UserListing::factory()->count(20)->create();
    }
}