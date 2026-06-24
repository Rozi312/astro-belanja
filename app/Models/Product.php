<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'short_description', 'description', 'image',
        'status', 'is_featured', 'sort_order',
    ];

    protected function casts(): array
    {
        return ['is_featured' => 'boolean'];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
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
