<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Listing;
use App\Models\Category;

class ListingSeeder extends Seeder
{
    public function run()
    {
        $cities = ['Berlin', 'München', 'Frankfurt', 'Hamburg', 'Köln', 'Stuttgart', 'Düsseldorf', 'Dortmund'];
        
        $mjekListings = [
            ['title' => 'Dr. Arben Krasniqi - Mjek i Përgjithshëm', 'description' => 'Mjek i përgjithshëm me përvojë 15 vjeçare. Shërbime mjekësore për të gjithë familjen. Flasim shqip.'],
            ['title' => 'Klinika Dentare Prishtina', 'description' => 'Klinikë moderne dentare me pajisje të fundit. Specialistë në implantologji dhe estetikë dentare.'],
            ['title' => 'Dr. Leonora Gashi - Pediatre', 'description' => 'Pediatre e specializuar për fëmijë. Vizita në shtëpi për rastet emergjente.'],
        ];
        
        $avokatListings = [
            ['title' => 'Avokat Besnik Hoxha', 'description' => 'Avokat i specializuar në të drejtën e emigracionit dhe azilimit. 20 vjet përvojë.'],
            ['title' => 'Zyra Ligjore Tirana', 'description' => 'Shërbime ligjore të plota: emigracion, familje, punë, dhe biznes.'],
            ['title' => 'Avokat Valbona Kelmendi', 'description' => 'Specialiste në të drejtën e familjes dhe të drejtën penale. Konsultime falas për rastet e para.'],
        ];
        
        $sherbimeListings = [
            ['title' => 'Përkthyes i Autorizuar Gjermanisht-Shqip', 'description' => 'Përkthime të certifikuara për dokumente zyrtare. Shërbim i shpejtë dhe profesional.'],
            ['title' => 'Kontabilitet Dardania', 'description' => 'Shërbime kontabiliteti për individë dhe biznese të vogla. Deklarim taksash.'],
            ['title' => 'Agjenci Udhëtimesh Kosovo Travel', 'description' => 'Bileta avioni për Kosovë, Shqipëri, Maqedoni. Çmimet më të mira në treg.'],
        ];
        
        $banesaListings = [
            ['title' => 'Apartament 3 Dhoma - Berlin Neukölln', 'description' => 'Apartament i mobiluar plotësisht, 3 dhoma gjumi, kuzhina e re. 950€/muaj.'],
            ['title' => 'Dhomë në Apartament të Përbashkët', 'description' => 'Dhomë e madhe në apartament modern. Afër transportit publik. 450€/muaj përfshirë faturat.'],
            ['title' => 'Shtëpi me Oborr - München', 'description' => 'Shtëpi 4 dhoma me oborr të madh. Ideale për familje. 1800€/muaj.'],
        ];
        
        $mjekCategory = Category::where('name', 'Mjek')->first();
        foreach ($mjekListings as $listing) {
            Listing::create(array_merge($listing, [
                'category_id' => $mjekCategory->id,
                'city' => $cities[array_rand($cities)],
                'phone' => '+49 ' . rand(100, 999) . ' ' . rand(1000000, 9999999),
                'email' => strtolower(str_replace(' ', '', $listing['title'])) . '@email.de',
                'active' => true,
                'featured' => rand(0, 1)
            ]));
        }
        
        $avokatCategory = Category::where('name', 'Avokat')->first();
        foreach ($avokatListings as $listing) {
            Listing::create(array_merge($listing, [
                'category_id' => $avokatCategory->id,
                'city' => $cities[array_rand($cities)],
                'phone' => '+49 ' . rand(100, 999) . ' ' . rand(1000000, 9999999),
                'email' => strtolower(str_replace(' ', '', $listing['title'])) . '@email.de',
                'website' => 'https://www.' . strtolower(str_replace(' ', '', $listing['title'])) . '.de',
                'active' => true,
                'featured' => rand(0, 1)
            ]));
        }
        
        $sherbimeCategory = Category::where('name', 'Shërbime')->first();
        foreach ($sherbimeListings as $listing) {
            Listing::create(array_merge($listing, [
                'category_id' => $sherbimeCategory->id,
                'city' => $cities[array_rand($cities)],
                'phone' => '+49 ' . rand(100, 999) . ' ' . rand(1000000, 9999999),
                'email' => strtolower(str_replace(' ', '', $listing['title'])) . '@email.de',
                'active' => true,
                'featured' => rand(0, 1)
            ]));
        }
        
        $banesaCategory = Category::where('name', 'Banesa')->first();
        foreach ($banesaListings as $listing) {
            Listing::create(array_merge($listing, [
                'category_id' => $banesaCategory->id,
                'city' => $cities[array_rand($cities)],
                'phone' => '+49 ' . rand(100, 999) . ' ' . rand(1000000, 9999999),
                'email' => 'banesa' . rand(1, 999) . '@email.de',
                'active' => true,
                'featured' => rand(0, 1)
            ]));
        }
        
        Listing::factory()->count(30)->create();
    }
}