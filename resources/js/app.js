import './bootstrap';
window.lightbox = function() {
    return {
        lightboxOpen: false,
        lightboxIndex: 0,
        lightboxImages: [],
        openLightbox(index) {
            this.lightboxIndex = index;
            this.lightboxOpen = true;
        }
    }
}
