<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SocialLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_social_login()
    {
        // Simulate the social login process
        // Socialite::shouldReceive('driver->redirect')->andReturn(Route::getFacadeRoot()->to('/callback'));

        // Perform the redirect to the social login provider
        $response = $this->get('/login/google'); // Replace "provider" with the actual social provider (e.g., "github", "google")

        // Assert that the response is a redirect
        $response->assertRedirect();

        // Follow the redirect and assert that the callback route is reached
        $response = $this->followRedirects($response);
        // $response->assertRouteIs('/login/google/callback'); // Replace "social.callback" with the actual callback route

        // Perform assertions based on the expected behavior after successful social login
        // ...
    }

    public function test_guest_can_not_access_dashboard()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

}
