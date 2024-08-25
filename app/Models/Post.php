<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['title', 'slug'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('lazy')
            ->performOnCollections('thumbnail')
            ->keepOriginalImageFormat()
            ->fit(Fit::Contain, 20);

        $this->addMediaConversion('square')
            ->performOnCollections('thumbnail')
            ->fit(Fit::Contain, 500, 500);
    }
}
