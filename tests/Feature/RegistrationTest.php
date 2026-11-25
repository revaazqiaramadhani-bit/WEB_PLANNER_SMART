<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_register_and_is_signed_in(): void
    {
        $response = $this->post('/register', [
            'name' => 'Alya Putri',
            'email' => 'alya@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/plans');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'name' => 'Alya Putri',
            'email' => 'alya@example.com',
        ]);
    }

    public function test_registration_rejects_duplicate_email_and_unconfirmed_password(): void
    {
        User::factory()->create(['email' => 'alya@example.com']);

        $this->from('/register')
            ->post('/register', [
                'name' => 'Alya Putri',
                'email' => 'alya@example.com',
                'password' => 'password123',
                'password_confirmation' => 'different123',
            ])
            ->assertRedirect('/register')
            ->assertSessionHasErrors(['email', 'password']);

        $this->assertGuest();
    }
}
