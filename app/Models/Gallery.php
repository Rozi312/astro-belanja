<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    protected $fillable = ['title', 'caption', 'image', 'status', 'sort_order'];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function getImageUrlAttribute(): string
    {
        return str_starts_with($this->image, 'seed:')
            ? asset('bootstrap-5.3.8-dist/images/'.substr($this->image, 5))
            : Storage::disk('public')->url($this->image);
    }
}
