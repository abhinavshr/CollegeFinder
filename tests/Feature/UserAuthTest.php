<?php

// tests/Feature/UserAuthTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_with_valid_details()
    {
        $response = $this->post('/register', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'testuser@example.com',
            'date_of_birth' => '2000-01-01',
            'password' => 'password',
            'password_confirmation' => 'password',
            'profile_picture' => 'default.png',
            'user_type' => 'normal',
        ]);

        $response->assertRedirect('/'); 
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
            'firstname' => 'Test',
        ]);
    }

    public function test_user_cannot_register_with_existing_email()
    {
        User::factory()->create([
            'email' => 'duplicate@example.com',
            'firstname' => 'Existing',
            'lastname' => 'User',
            'date_of_birth' => '2000-01-01',
            'password' => bcrypt('password'),
            'profile_picture' => 'default.png',
            'user_type' => 'normal',
        ]);

        $response = $this->post('/register', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => 'duplicateemail@example.com',
            'date_of_birth' => '1999-12-31',
            'password' => 'password',
            'password_confirmation' => 'password',
            'profile_picture' => 'avatar.png',
            'user_type' => 'normal',
        ]);

        $response->assertSessionHasErrors('email');
    }
}
