<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Livewire\Workspace\Create;
use App\Models\Workspace;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;
use Tests\TestCase;

class CreateWorkspaceTest extends TestCase
{
    use DatabaseTransactions;


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_auth_user_can_create_workspace()
    {
        $user = $this->actingAs(User::factory()->create());
        Livewire::test(Create::class)
        ->set('workspaceName', 'nni')
        ->call('save');

        $this->assertTrue(Workspace::where('name','nni')->exists());
    }
}
