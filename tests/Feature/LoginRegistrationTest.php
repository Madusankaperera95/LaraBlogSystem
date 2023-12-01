<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginRegistrationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_registration_page_lands_succsfully()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }

    public function test_registration(): void
    {

        $response = $this->post(route('register.post'), [
            'name' => 'Kasun Perera',
            'email' => 'kasun@gmail.com',
            'password' => 'pass123',
            'password_confirmation' => 'pass123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirectToRoute('dashboard');
        $this->assertDatabaseHas('users',['email' => 'kasun@gmail.com',]);
    }

    public function test_it_fails_when_required_parameters_not_supplied(): void
    {
        $response = $this->post(route('register.post'));
        $response->assertSessionHasErrors(['name','email','password']);
    }

    public function test_login_page_landed_succesfully()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    public function test_login_functonality_works_succesfully()
    {
        $user = User::factory()->create(['password' => 'pass123!' ]);
        $response = $this->post(route('login.post'),['email' => $user->email ,'password' => 'pass123!']);
        $this->assertAuthenticated();
        $response->assertRedirectToRoute('dashboard');
    }

    public function test_login_fails_when_wrong_credentials_provided(){
        $user = User::factory()->create();
        $response = $this->post(route('login.post'),['email' => $user->email ,'password' => 'pass123!']);
        $this->assertGuest();
        $response->assertRedirectToRoute('login');

    }
}
