<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    private $cities = [
        [
            'id' => '1',
            'name' => 'Tanger',
        ],
        [
            'id' => '2',
            'name' => 'Tétouan',
        ],
        [
            'id' => '3',
            'name' => 'Larache',
        ],
        [
            'id' => '4',
            'name' => 'Fes',
        ],
        [
            'id' => '5',
            'name' => 'Meknes',
        ],
        [
            'id' => '6',
            'name' => 'Casablanca',
        ],
        [
            'id' => '7',
            'name' => 'Rabat',
        ],
        [
            'id' => '8',
            'name' => 'Marrakech',
        ],
        [
            'id' => '9',
            'name' => 'Laayoun',
        ],
        [
            'id' => '10',
            'name' => 'Oujda',
        ],
        [
            'id' => '11',
            'name' => 'Autres',
        ],
       
    ];

    public function run()
    {
        array_walk($this->cities, function ($cities) {
            City::create($cities);
        });
    }
}
