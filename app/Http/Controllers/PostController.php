<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Jobs\ResizeVariants;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;

class PostController extends Controller
{
    protected array $rules = [
        'title' => 'required|string|max:255',
        'thumbnail' => 'required|mimes:jpg,png,jpeg',
    ];

    public function create(Request $request)
    {
        $request->validate($this->rules);
        $post = $this->save($request->only('title', 'thumbnail'));
        ResizeVariants::dispatch($post);

        return back();
    }

    public function save(array $attributes, null|Post $post = null)
    {
        $attributes['thumbnail'] = $this->manageImage($attributes['thumbnail']);
        $attributes['slug'] = Str::slug($attributes['title']);
        $post = Post::updateOrCreate([
            'slug' => $attributes['slug']
        ], $attributes);

        return $post;
    }

    protected function manageImage(UploadedFile $file): string
    {
        $path = $file->store('posts/' . Str::uuid(), 'public');
        return $path;
    }
}
