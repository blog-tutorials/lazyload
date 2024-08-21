<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use SplFileInfo;

class PostController extends Controller
{
    protected array $rules = [
        'title' => 'required|string|max:255',
        'thumbnail' => 'required|mimes:jpg,png,jpeg',
    ];

    public function create(Request $request)
    {
        $request->validate($this->rules);
        $this->save($request->except('_token'));

        return back();
    }

    public function save(array $attributes, null|Post $post = null)
    {
        if (!$post) {
            $post = new Post();
        };

        $post->title = $attributes['title'];
        $post->slug = Str::slug($attributes['title']);
        $post->thumbnail = $this->manageImage($attributes['thumbnail']);

        $post->save($attributes);
    }

    protected function manageImage($file): string
    {
        $path = $file->store('posts/' . Str::uuid(), 'public');
        $file = new SplFileInfo($path);
        $lazy = $file->getPath() . '/' . $file->getBasename('.' . $file->getExtension()) . '-lazy.' . $file->getExtension();

        // create image manager with desired driver
        $image = ImageManager::imagick()
            ->read(public_path('storage/' . $path))
            ->scale(width: 20)
            ->save(public_path('storage/' . $lazy));


        return $path;
    }
}
