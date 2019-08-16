<?php

use Illuminate\Database\Seeder;

class CitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ru = config('custom.language_ru');
        $en = config('custom.language_en');
        $items = [

            ['id' => 1, $ru => ['name' => 'Все'], $en => ['name' => 'All'], 'key' => null, 'order' => 10, 'active' => 1,],
            ['id' => 2, $ru => ['name' => 'Москва'], $en => ['name' => 'Moscow'], 'key' => 'moscow', 'order' => 20, 'active' => 1,],
            ['id' => 3, $ru => ['name' => 'Париж'], $en => ['name' => 'Paris'], 'key' => 'paris', 'order' => 30, 'active' => 1,],
            ['id' => 4, $ru => ['name' => 'Берлин'], $en => ['name' => 'Berlin'], 'key' => 'berlin', 'order' => 40, 'active' => 1,],

        ];

        foreach ($items as $item) {
            \App\City::create($item);
        }
    }
}
