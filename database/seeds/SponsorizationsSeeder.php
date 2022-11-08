<?php

use App\Sponsorization;
use Illuminate\Database\Seeder;

class SponsorizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorizations = [
            [
                'name' => 'Min',
                'price' => 2.99,
                'duration' => 24
            ],
            [
                'name' => 'Mid',
                'price' => 5.99,
                'duration' => 72
            ],
            [
                'name' => 'Plus',
                'price' => 9.99,
                'duration' => 144
            ],
        ];


        foreach($sponsorizations as $sponsorization){
                $newSponsorization = new Sponsorization();

                $newSponsorization->name = $sponsorization['name'];
                $newSponsorization->price = $sponsorization['price'];
                $newSponsorization->duration = $sponsorization['duration'];
                
                $newSponsorization->save();
        }
    }
}
