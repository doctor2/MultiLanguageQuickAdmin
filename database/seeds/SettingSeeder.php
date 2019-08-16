<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $settings = Setting::all();
        foreach ($settings as $setting) {
            $setting->delete();
        }

        $data = [
            [
                'id' => '1',
                'key' => 'projectPreviewWidth',
                'description' => 'Ширина превью изображений(Для проектов, 0 - отсутствие ресайза)',
                'ru' => '',
                'en' => '800'
            ],
            [
                'id' => '2',
                'key' => 'projectPreviewHeight',
                'description' => 'Высота превью изображений(Для проектов, 0 - отсутствие ресайза)',
                'ru' => '',
                'en' => '800'
            ],
        ];

        foreach ($data as $value) {
            Setting::create([
                'id' => $value['id'],
                'key' => $value['key'],
                'description' => $value['description'] ?? '',
                config('custom.language_ru') => [
                    'name' => $value['ru']
                ],
                config('custom.language_en') => [
                    'name' => $value['en']
                ]
            ]);
        }
    }
}
