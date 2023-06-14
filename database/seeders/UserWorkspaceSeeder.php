<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserWorkspace;
use App\Models\Workspace;
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
        $workspaces = Workspace::all();
        foreach ($workspaces as $workspace) {
            
           UserWorkspace::factory()->create([
            'workspace_id' => $workspace->id,
            'user_id' => User::inRandomOrder()->first(),
            'role_id' => 1,
           ]);
        }
    }
}
