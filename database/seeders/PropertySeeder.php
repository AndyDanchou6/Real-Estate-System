<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::create([
            'title' => 'Danchou Homes',
            'owner' => 'Andy Danchou',
            'type' => 'house',
            'size' => 200,
            'adType' => 'forSale',
            'bedrooms' => 3,
            'location' => 'Brgy. Hampangan Hilongos Leyte',
            'price' => 734000,
            'term' => 5,
            'monthly' => 15000,
            'agent_id' => 2,
            'image' => '/images/house-image.jpeg',
        ]);

        Property::create([
            'title' => 'Danchou Homes',
            'owner' => 'Andy Danchou',
            'type' => 'house',
            'size' => 260,
            'adType' => 'forRent',
            'bedrooms' => 3,
            'location' => 'Brgy. Hampangan Hilongos Leyte',
            'rent' => 13000,
            'agent_id' => 2,
            'image' => '/images/house-image.jpeg',
        ]);

        Property::create([
            'title' => 'Danchou Lands',
            'owner' => 'Andy Danchou',
            'type' => 'land',
            'size' => 267,
            'adType' => 'forRent',
            'location' => 'Brgy. Talisay Hilongos Leyte',
            'rent' => 15000,
            'agent_id' => 2,
            'image' => '/images/land-image1.jpeg',
        ]);

        Property::create([
            'title' => 'Danchou Lands',
            'owner' => 'Andy Danchou',
            'type' => 'land',
            'size' => 140,
            'adType' => 'forSale',
            'location' => 'Brgy. Cacao Hilongos Leyte',
            'price' => 202700,
            'term' => 6,
            'monthly' => 35000,
            'agent_id' => 2,
            'image' => '/images/land-image1.jpeg',
        ]);

        Property::create([
            'title' => 'Danchou Commercials',
            'owner' => 'Andy Danchou',
            'type' => 'commercial',
            'size' => 200,
            'adType' => 'forRent',
            'location' => 'Brgy. Talisay Hilongos Leyte',
            'rent' => 12000,
            'agent_id' => 2,
            'image' => '/images/commercial-image.jpg',
        ]);

        Property::create([
            'title' => 'Danchou Commercials',
            'owner' => 'Andy Danchou',
            'type' => 'commercial',
            'size' => 350,
            'adType' => 'forSale',
            'location' => 'Brgy. Hampangan Hilongos Leyte',
            'price' => 961000,
            'term' => 5,
            'monthly' => 20000,
            'agent_id' => 2,
            'image' => '/images/commercial-image.jpg',
        ]);
    }
}
