<?php

namespace Database\Seeders;

use App\Models\UserWorkspace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserWorkspaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserWorkspace::factory(2000)->create();
    }
}
