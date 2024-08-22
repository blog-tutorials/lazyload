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
        $post = $this->save($request->except('_token'));


        return back();
    }

    public function save(array $attributes, null|Post $post = null)
    {
        if (!$post) {
            $post = new Post();
        };

        $post->title = $attributes['title'];
        $post->slug = Str::slug($attributes['title']);
        $post->save($attributes);

        $post->addMedia($attributes['thumbnail'])
            ->toMediaCollection('thumbnail');

        return $post->refresh();
    }
}
