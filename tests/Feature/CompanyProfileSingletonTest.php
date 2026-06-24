<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\CompanyProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CompanyProfileSingletonTest extends TestCase
{
    use RefreshDatabase;

    private Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::create([
            'name' => 'Admin Test',
            'email' => 'admin@example.com',
            'password' => 'secret123',
        ]);

        Storage::fake('public');
    }

    public function test_guest_cannot_access_company_profile_settings(): void
    {
        $this->get(route('admin.profile.edit'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_empty_company_profile_form_can_be_opened(): void
    {
        $this->actingAsAdmin()
            ->get(route('admin.profile.edit'))
            ->assertOk()
            ->assertSee('Profil Perusahaan')
            ->assertSee('Simpan Perubahan');
    }

    public function test_first_submit_creates_profile_and_next_submit_updates_same_record(): void
    {
        $this->actingAsAdmin()->put(route('admin.profile.update'), [
            'company_name' => 'Astro Pertama',
            'tagline' => 'Tagline pertama',
            'location' => 'Jakarta',
            'vision' => 'Menjadi perusahaan terbaik.',
            'description' => 'Deskripsi perusahaan pertama.',
            'email' => 'hello@astro.test',
            'phone' => '021123456',
        ])->assertRedirect(route('admin.profile.edit'));

        $profile = CompanyProfile::firstOrFail();
        $this->assertSame(1, CompanyProfile::count());

        $this->actingAsAdmin()->put(route('admin.profile.update'), [
            'company_name' => 'Astro Diperbarui',
            'tagline' => 'Tagline baru',
            'location' => 'Tangerang',
            'vision' => 'Visi yang sudah diperbarui.',
            'description' => 'Deskripsi perusahaan yang sudah diperbarui.',
            'email' => 'contact@astro.test',
            'phone' => '021987654',
        ])->assertRedirect(route('admin.profile.edit'));

        $this->assertSame(1, CompanyProfile::count());
        $this->assertDatabaseHas('company_profiles', [
            'id' => $profile->id,
            'company_name' => 'Astro Diperbarui',
            'location' => 'Tangerang',
        ]);
    }

    public function test_replacing_profile_image_deletes_previous_uploaded_file(): void
    {
        $this->actingAsAdmin()->put(route('admin.profile.update'), [
            'company_name' => 'Astro',
            'location' => 'Jakarta',
            'vision' => 'Visi perusahaan.',
            'description' => 'Deskripsi perusahaan.',
            'image' => UploadedFile::fake()->image('first.jpg'),
        ]);

        $profile = CompanyProfile::firstOrFail();
        $oldImage = $profile->image;
        Storage::disk('public')->assertExists($oldImage);

        $this->actingAsAdmin()->put(route('admin.profile.update'), [
            'company_name' => 'Astro',
            'location' => 'Jakarta',
            'vision' => 'Visi perusahaan.',
            'description' => 'Deskripsi perusahaan.',
            'image' => UploadedFile::fake()->image('second.jpg'),
        ]);

        $profile->refresh();
        Storage::disk('public')->assertMissing($oldImage);
        Storage::disk('public')->assertExists($profile->image);
    }

    public function test_old_profile_crud_routes_are_not_available(): void
    {
        $this->actingAsAdmin()->get('/admin/profiles')->assertNotFound();
        $this->actingAsAdmin()->get('/admin/profiles/create')->assertNotFound();
        $this->actingAsAdmin()->delete('/admin/profiles/1')->assertNotFound();
    }

    public function test_about_page_uses_single_profile_and_has_empty_fallback(): void
    {
        $this->get(route('about'))->assertOk()->assertSee('Astro Belanja Indonesia');

        CompanyProfile::create([
            'company_name' => 'Astro Singleton',
            'location' => 'Jakarta',
            'vision' => 'Visi singleton.',
            'description' => 'Deskripsi singleton.',
            'is_active' => false,
        ]);

        $this->get(route('about'))
            ->assertOk()
            ->assertSee('Astro Singleton')
            ->assertSee('Visi singleton.');
    }

    private function actingAsAdmin(): static
    {
        return $this->withSession([
            'admin_id' => $this->admin->id,
            'admin_name' => $this->admin->name,
        ]);
    }
}
