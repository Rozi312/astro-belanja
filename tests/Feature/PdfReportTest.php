<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PdfReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_pdf_report_is_protected_and_can_be_downloaded_by_admin(): void
    {
        $this->get(route('admin.blogs.export-pdf'))->assertRedirect(route('admin.login'));

        $admin = Admin::create([
            'name' => 'Admin PDF', 'email' => 'pdf@example.com', 'password' => 'secret',
        ]);
        Blog::create([
            'title' => 'Artikel PDF', 'slug' => 'artikel-pdf', 'content' => 'Konten',
            'author' => 'Admin', 'status' => 'published', 'published_at' => now(),
        ]);

        $this->withSession(['admin_id' => $admin->id, 'admin_name' => $admin->name])
            ->get(route('admin.blogs.export-pdf'))
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf');
    }
}
