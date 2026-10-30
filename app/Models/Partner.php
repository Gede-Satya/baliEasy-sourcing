<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory, SoftDeletes;

    public const TYPE_STAY = 'stay';
    public const TYPE_EAT = 'eat';

    protected $fillable = [
        'type',
        'name',
        'slug',
        'description',
        'area',
        'price_range',
        'maps_url',
        'website_url',
        'instagram_url',
        'phone',
        'cover_image',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function images(): HasMany
    {
        return $this->hasMany(PartnerImage::class)->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeStay($query)
    {
        return $query->where('type', self::TYPE_STAY);
    }

    public function scopeEat($query)
    {
        return $query->where('type', self::TYPE_EAT);
    }
}

