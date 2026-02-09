<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Listing;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $listings = Listing::all();
        
        $reviews = [
            [
                'reviewer_name' => 'Agron Berisha',
                'rating' => 5,
                'comment' => 'Shërbim shumë profesional dhe i shpejtë. Rekomandoj me gjithë zemër!'
            ],
            [
                'reviewer_name' => 'Valdete Krasniqi',
                'rating' => 5,
                'comment' => 'Më ndihmuan shumë me dokumentet e mia. Faleminderit për gjithçka!'
            ],
            [
                'reviewer_name' => 'Besnik Hoxha',
                'rating' => 4,
                'comment' => 'Eksperiencë e mirë në përgjithësi. Çmimet janë të arsyeshme dhe cilësia e mirë.'
            ],
            [
                'reviewer_name' => 'Leonora Gashi',
                'rating' => 5,
                'comment' => 'E rekomandoj fuqishëm! Stafi është shumë i sjellshëm dhe i kujdesshëm.'
            ],
            [
                'reviewer_name' => 'Arben Murati',
                'rating' => 4,
                'comment' => 'Shërbim i shkëlqyer. Më ndihmuan të zgjidhja problemin tim shpejt e mirë.'
            ],
            [
                'reviewer_name' => 'Valbona Sejdiu',
                'rating' => 5,
                'comment' => 'Jam shumë e kënaqur me shërbimin. Profesionalizëm në maksimum!'
            ],
            [
                'reviewer_name' => 'Driton Shabani',
                'rating' => 3,
                'comment' => 'Shërbim i mirë por koha e pritjes ishte pak e gjatë. Gjithsesi e rekomandoj.'
            ],
            [
                'reviewer_name' => 'Fatime Kastrati',
                'rating' => 5,
                'comment' => 'Fantastik! Faleminderit për ndihmën tuaj të pazëvendësueshme.'
            ],
            [
                'reviewer_name' => 'Ramiz Demolli',
                'rating' => 4,
                'comment' => 'Cilësi e lartë dhe çmime konkurruese. Do të kthehem përsëri.'
            ],
            [
                'reviewer_name' => 'Shqipe Surroi',
                'rating' => 5,
                'comment' => 'Më kanë ndihmuar shumë herë dhe gjithmonë me profesionalizëm të lartë!'
            ]
        ];
        
        foreach ($listings->take(15) as $listing) {
            $numReviews = rand(2, 5);
            
            for ($i = 0; $i < $numReviews; $i++) {
                $review = $reviews[array_rand($reviews)];
                
                Review::create([
                    'listing_id' => $listing->id,
                    'user_id' => null,
                    'reviewer_name' => $review['reviewer_name'],
                    'reviewer_email' => strtolower(str_replace(' ', '.', $review['reviewer_name'])) . '@email.com',
                    'rating' => $review['rating'],
                    'comment' => $review['comment'],
                    'approved' => rand(0, 100) < 80
                ]);
            }
            
            $listing->updateRating();
        }
    }
}