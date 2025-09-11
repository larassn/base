<?php

namespace Modules\Base\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SocialPlatform extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'url',
        'icon',
        'priority',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'priority' => 'integer',
    ];

    public function collectionItems(): MorphMany
    {
        return $this->morphMany(\Modules\Collection\Models\CollectionItem::class, 'itemable');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('priority');
    }
}
