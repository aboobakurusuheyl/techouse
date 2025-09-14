<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'sale_price',
        'sku',
        'stock_quantity',
        'images',
        'specifications',
        'is_featured',
        'is_active',
        'brand_id',
        'category_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'images' => 'array',
        'specifications' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'ރ' . number_format($this->price, 2);
    }

    public function getFormattedSalePriceAttribute(): string
    {
        return $this->sale_price ? 'ރ' . number_format($this->sale_price, 2) : null;
    }

    public function getImageUrlsAttribute(): array
    {
        if (!$this->images) {
            return [];
        }

        return collect($this->images)->map(function ($image) {
            if (str_starts_with($image, 'http')) {
                return $image;
            }
            return asset('storage/' . $image);
        })->toArray();
    }
}
