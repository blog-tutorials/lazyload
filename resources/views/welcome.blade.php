<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LazyLoad</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <img src="https://picsum.photos/2000/2000?random=1" data-lazyload="loading" loading="lazy" alt="youhou some image">

    <img data-src="https://picsum.photos/2000/2000?random=2" data-lazyload="loading" alt="youhou some image">
</body>

</html>
