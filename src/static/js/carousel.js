function moveCarousel(carouselContainer, direction) {
    const track = carouselContainer.querySelector(".carousel-track");
    const boxes = carouselContainer.querySelectorAll(".restaurant-box");
    const visibleItems = 4; // Nombre d'éléments affichés simultanément
    const totalRestaurants = boxes.length;
    const itemWidth = boxes[0].offsetWidth + 20; // Largeur + marge entre les cartes

    // Mise à jour de l'index avec limites
    const maxIndex = totalRestaurants - visibleItems;
    
    let currentIndex = parseInt(carouselContainer.dataset.index) || 0;
    
    currentIndex += direction * visibleItems;
    if (currentIndex < 0) currentIndex = 0;
    if (currentIndex > maxIndex) currentIndex = maxIndex;
    
    carouselContainer.dataset.index = currentIndex;
    // Appliquer la translation
    track.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
}

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".restaurant-carousel").forEach(carousel => {
        const prevBtn = carousel.querySelector(".prev-btn");
        const nextBtn = carousel.querySelector(".next-btn");
        
        prevBtn.addEventListener("click", () => moveCarousel(carousel, -1));
        nextBtn.addEventListener("click", () => moveCarousel(carousel, 1));
        
        carousel.dataset.index = 0;
    });
});


