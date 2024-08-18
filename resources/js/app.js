import './bootstrap';

window.addEventListener('load', () => {
    document.querySelectorAll('[data-lazyload]').forEach(picture => new LazyImage(picture));
});

class LazyImage {
    constructor(picture) {
        //Work with the image container
        this.picture = picture;

        //this works for both versions, if you only use one, modify the querySelector
        this.img = this.picture.querySelector('[loading="lazy"], [data-src]');

        if (this.img) this.init();
    }

    init() {
        // For those who prefer the data-src version.
        if (this.img.dataset.src) {
            this.img.src = this.img.dataset.src;
        }

        this.img.complete
            ? this.loaded()
            : this.img.addEventListener("load", e => this.loaded(e))
    }

    loaded() {
        this.picture.setAttribute('data-lazyload', 'loaded');
    }
}
