<?php

namespace App\Models;

use App\Models\Concerns\HasVariants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    public array $variants = [
        'thumbnail' => [
            'square' => ['width' => 500, 'height' => 500],
            'lazy' => ['width' => 20],
        ]
    ];

    use HasFactory, HasVariants;
}
