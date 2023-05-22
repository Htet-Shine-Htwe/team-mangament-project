<?php

namespace Database\Seeders;

use App\Models\Icon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $icons =[
           (object) [
            'name' => 'bell',
            'unicode' => 'f0f3'
           ],
           (object) [
            'name' => 'backspace',
            'unicode' => 'f55a'
           ],
           (object) [
            'name' => 'bahai',
            'unicode' => 'f666'
           ],
        ];
        foreach($icons as $icon)
        {
            Icon::factory()->create([
                'prefix' => 'fa-solid fa-',
                'icon_name' => $icon->name,
                'unicode' => $icon->unicode
            ]);
        }

    }
}
