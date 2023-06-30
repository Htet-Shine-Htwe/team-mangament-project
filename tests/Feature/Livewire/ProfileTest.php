<?php

namespace Tests\Feature\Livewire;

use App\Models\User;
use App\Http\Livewire\Profile\Index;
use App\Models\UserWorkspace;
use App\Models\Workspace;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_view_profile()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $realuser = $user->first();
        $workspace = Workspace::factory()->create()->first();
        $userWorkspace = UserWorkspace::factory()->create([
            'user_id' => $realuser->id,
            'workspace_id' => $workspace->id,
            'role_id' => 1
        ]);
        $this->get('/workspaces/'.$workspace->name.'/profile/'.$realuser->email)
            ->assertStatus(200);

    }
}
