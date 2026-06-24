<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_dashboard(): void
    {
        $this->get('/admin')->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_login_and_logout_with_manual_session_authentication(): void
    {
        $admin = Admin::create([
            'name' => 'Admin Test',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret123'),
        ]);

        $response = $this->post(route('admin.login.attempt'), [
            'email' => $admin->email,
            'password' => 'secret123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedSession($admin);

        $this->post(route('admin.logout'))
            ->assertRedirect(route('admin.login'))
            ->assertSessionMissing('admin_id');
    }

    public function test_invalid_admin_credentials_are_rejected(): void
    {
        Admin::create([
            'name' => 'Admin Test',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret123'),
        ]);

        $this->post(route('admin.login.attempt'), [
            'email' => 'admin@example.com',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors('email');
    }

    private function assertAuthenticatedSession(Admin $admin): void
    {
        $this->assertSame($admin->id, session('admin_id'));
        $this->assertSame($admin->name, session('admin_name'));
    }
}
