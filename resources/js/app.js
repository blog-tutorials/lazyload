import './bootstrap';

window.addEventListener('load', () => {
    document.querySelectorAll('[data-lazyload]').forEach(image => new LazyImage(image));
});

class LazyImage {
    constructor(image) {
        this.img = image;
        this.init();
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
        this.img.setAttribute('data-lazyload', 'loaded');
    }
}
