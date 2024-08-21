<?php

namespace App\Models;

use App\Models\Concerns\HasVariants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, HasVariants;
}
