<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LazyLoad</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <h1>Lazy loading backend</h1>

    <x-post-form />

    <section class="posts">
        @foreach ($posts as $post)
            <article class="post-card">
                <h2 class="post-card__title">{{ $post->title }}</h2>
                <x-lazy-image src="{{ asset($post->thumbnail) }}"
                    lazy="{{ asset($post->getVariant('thumbnail', 'lazy')) }}" alt="Lorem" />
            </article>
        @endforeach
    </section>

    {{-- <picture data-lazyload="loading" style="--img: url(https://picsum.photos/20/20?random=1);">
        <img src="https://picsum.photos/2000/2000?random=1" loading="lazy">
    </picture>

    <picture data-lazyload="loading" style="--img: url(https://picsum.photos/20/20?random=2);">
        <img data-src="https://picsum.photos/2000/2000?random=2">
    </picture> --}}
</body>

</html>
