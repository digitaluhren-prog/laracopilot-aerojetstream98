<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Mjek', 'description' => 'Shërbime mjekësore dhe klinika'],
            ['name' => 'Avokat', 'description' => 'Shërbime ligjore dhe avokatë'],
            ['name' => 'Shërbime', 'description' => 'Shërbime të ndryshme për komunitetin'],
            ['name' => 'Banesa', 'description' => 'Banesa dhe apartamente me qira'],
            ['name' => 'Restorante', 'description' => 'Restorante dhe kafene shqiptare'],
            ['name' => 'Dyqane', 'description' => 'Dyqane dhe supermarkete'],
            ['name' => 'Transport', 'description' => 'Shërbime transporti dhe logistike'],
            ['name' => 'Ndërtim', 'description' => 'Kompani ndërtimi dhe rinovimi'],
            ['name' => 'Pastrimi', 'description' => 'Shërbime pastrimi dhe mirëmbajtje'],
            ['name' => 'Teknologji', 'description' => 'Shërbime IT dhe teknologjike']
        ];
        
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}