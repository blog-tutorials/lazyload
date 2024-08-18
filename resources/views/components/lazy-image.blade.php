@if ($image)
    <picture class="{{ $bem ? $bem . '__img-wrapper' : '' }}" data-lazyload="loading"
        style="--img: url({{ $image->getUrl('lazy') }});">
        <img class="{{ $bem ? $bem . '__img' : '' }}" src="{{ $image->getUrl() }}" loading="lazy" alt="{{ $alt }}">
    </picture>
@else
    <picture class="{{ $bem ? $bem . '__img-wrapper' : '' }}">
        <img class="{{ $bem ? $bem . '__img' : '' }}" src="#" alt="{{ $alt }}">
    </picture>
@endif
