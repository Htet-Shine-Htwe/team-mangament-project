<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1000)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'hsh@gmail.com',
            'password' => Hash::make('asdffdsa')
        ]);

        $this->call([
            RoleSeeder::class,
            IconSeeder::class,
            WorkspaceSeeder::class,
            UserWorkspaceSeeder::class,
        ]);

        session()->flush();


        $file = new Filesystem;
        $file->cleanDirectory('storage/app/public/');

        echo "\e[93mStorage Cleaned \n";
    }
}
