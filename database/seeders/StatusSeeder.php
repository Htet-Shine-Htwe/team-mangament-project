<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statues = [
            'Backlog' => '#87807a',
            'Todo' => '#ed7105',
            'In Progress' => '#eded05',
            'Done' => '#00d103',
            'Canceled' => '#FF5733',];

        forEach($statues as $title => $color)
        {
            \App\Models\Status::factory()->create([
                'title' => $title,
                'color' => $color,
            ]);
        }
    }
}
