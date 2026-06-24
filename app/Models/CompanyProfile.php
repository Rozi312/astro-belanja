<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CompanyProfile extends Model
{
    protected $fillable = [
        'company_name', 'tagline', 'location', 'vision', 'description',
        'email', 'phone', 'image', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return str_starts_with($this->image, 'seed:')
            ? asset('bootstrap-5.3.8-dist/images/'.substr($this->image, 5))
            : Storage::disk('public')->url($this->image);
    }
}
