let currentIndex = 0;
const track = document.querySelector(".carousel-track");
const boxes = document.querySelectorAll(".restaurant-box");
const totalRestaurants = boxes.length;
const visibleItems = 4; // Nombre d'éléments affichés simultanément

function moverestaurant(direction) {
    const itemWidth = boxes[0].offsetWidth + 20; // Largeur + marge entre les cartes
    const maxIndex = totalRestaurants - visibleItems; // Dernier index possible avant dépassement

    // Mise à jour de l'index avec limites
    currentIndex += direction * visibleItems;
    if (currentIndex < 0) currentIndex = 0;
    if (currentIndex > maxIndex) currentIndex = maxIndex;

    // Appliquer la translation
    track.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
}
