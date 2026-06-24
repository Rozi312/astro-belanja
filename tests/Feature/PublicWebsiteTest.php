<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Gallery;
use App\Models\PartnershipInquiry;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicWebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_work_when_database_is_empty(): void
    {
        $this->get('/')->assertOk()->assertSee('Astro Belanja');
        $this->get('/about')->assertOk();
        $this->get('/blog')->assertOk();
        $this->get('/products')->assertOk();
        $this->get('/gallery')->assertOk();
        $this->get('/partnership')->assertOk();
    }

    public function test_frontend_only_displays_published_content(): void
    {
        $published = Blog::create([
            'title' => 'Artikel Publik', 'slug' => 'artikel-publik', 'content' => 'Konten publik',
            'author' => 'Admin', 'status' => 'published', 'published_at' => now()->subMinute(),
        ]);
        Blog::create([
            'title' => 'Artikel Draft', 'slug' => 'artikel-draft', 'content' => 'Konten draft',
            'author' => 'Admin', 'status' => 'draft',
        ]);
        Product::create([
            'name' => 'Produk Publik', 'slug' => 'produk-publik',
            'short_description' => 'Singkat', 'description' => 'Lengkap',
            'status' => 'published', 'sort_order' => 1,
        ]);
        Gallery::create([
            'title' => 'Galeri Publik', 'image' => 'seed:astro_home1.png',
            'status' => 'published', 'sort_order' => 1,
        ]);

        $this->get('/blog')->assertSee('Artikel Publik')->assertDontSee('Artikel Draft');
        $this->get(route('blog.show', $published->slug))->assertOk()->assertSee('Konten publik');
        $this->get('/products')->assertSee('Produk Publik');
        $this->get('/gallery')->assertSee('Galeri Publik');
    }

    public function test_partnership_form_validates_and_saves_inquiry(): void
    {
        $this->post(route('partnership.store'), [
            'name' => 'PT Mitra Segar',
            'email' => 'mitra@example.com',
            'category' => 'sayur',
            'message' => 'Kami ingin menawarkan pasokan sayuran segar setiap hari.',
        ])->assertRedirect()->assertSessionHas('success');

        $this->assertDatabaseHas('partnership_inquiries', [
            'email' => 'mitra@example.com',
            'status' => 'baru',
        ]);

        $this->post(route('partnership.store'), [
            'name' => '', 'email' => 'bukan-email', 'category' => 'invalid', 'message' => 'pendek',
        ])->assertSessionHasErrors(['name', 'email', 'category', 'message']);
        $this->assertSame(1, PartnershipInquiry::count());
    }
}
