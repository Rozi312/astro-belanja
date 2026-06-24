<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminCrudTest extends TestCase
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
        $this->withSession(['admin_id' => $this->admin->id, 'admin_name' => $this->admin->name]);
        Storage::fake('public');
    }

    public function test_admin_can_create_update_and_delete_blog_with_image(): void
    {
        $this->post(route('admin.blogs.store'), [
            'title' => 'Artikel Baru',
            'slug' => 'artikel-baru',
            'excerpt' => 'Ringkasan artikel baru.',
            'content' => 'Isi artikel baru yang lengkap.',
            'author' => 'Admin',
            'status' => 'published',
            'published_at' => now()->format('Y-m-d H:i:s'),
            'image' => UploadedFile::fake()->image('article.jpg', 800, 500),
        ])->assertRedirect(route('admin.blogs.index'));

        $blog = Blog::firstOrFail();
        Storage::disk('public')->assertExists($blog->image);

        $this->put(route('admin.blogs.update', $blog), [
            'title' => 'Artikel Diperbarui',
            'slug' => 'artikel-diperbarui',
            'excerpt' => 'Ringkasan baru.',
            'content' => 'Isi artikel yang sudah diperbarui.',
            'author' => 'Admin',
            'status' => 'draft',
            'published_at' => null,
        ])->assertRedirect(route('admin.blogs.index'));

        $this->assertDatabaseHas('blogs', ['slug' => 'artikel-diperbarui', 'status' => 'draft']);
        $this->delete(route('admin.blogs.destroy', $blog))->assertSessionHas('success');
        $this->assertDatabaseMissing('blogs', ['id' => $blog->id]);
        Storage::disk('public')->assertMissing($blog->image);
    }

    public function test_blog_slug_must_be_unique_and_upload_must_be_an_image(): void
    {
        Blog::create([
            'title' => 'Existing', 'slug' => 'existing', 'content' => 'Content',
            'author' => 'Admin', 'status' => 'draft',
        ]);

        $this->post(route('admin.blogs.store'), [
            'title' => 'Duplicate', 'slug' => 'existing', 'content' => 'Content',
            'author' => 'Admin', 'status' => 'draft',
            'image' => UploadedFile::fake()->create('document.pdf', 100, 'application/pdf'),
        ])->assertSessionHasErrors(['slug', 'image']);
    }

    public function test_admin_can_manage_product_and_gallery(): void
    {
        $this->post(route('admin.products.store'), [
            'name' => 'Layanan Test', 'slug' => 'layanan-test',
            'short_description' => 'Deskripsi singkat produk.',
            'description' => 'Deskripsi lengkap produk.', 'status' => 'published',
            'sort_order' => 1, 'is_featured' => 1,
        ])->assertRedirect(route('admin.products.index'));
        $this->assertDatabaseHas('products', ['slug' => 'layanan-test']);

        $this->post(route('admin.galleries.store'), [
            'title' => 'Galeri Test', 'caption' => 'Dokumentasi',
            'status' => 'published', 'sort_order' => 1,
            'image' => UploadedFile::fake()->image('gallery.png', 900, 600),
        ])->assertRedirect(route('admin.galleries.index'));
        $gallery = Gallery::firstOrFail();
        Storage::disk('public')->assertExists($gallery->image);

        $product = Product::firstOrFail();
        $this->delete(route('admin.products.destroy', $product))->assertSessionHas('success');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
