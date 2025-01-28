document.addEventListener("DOMContentLoaded", function () {
    // Initialisation de la carte et centrage sur la France
    var map = L.map('map').setView([46.903354, 1.888334], 5); // France

    // Ajout des tuiles OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // console.log(addresses.length);

    // Parcours des adresses et ajout des marqueurs
    addresses.forEach(function (restaurant) {
        // Vérifier que les coordonnées sont valides avant d'ajouter le marqueur
        if (restaurant.lat && restaurant.lng) {
            var latLng = [restaurant.lat, restaurant.lng];
            if (addresses.length > 1) {
                L.marker(latLng).addTo(map)
                    .bindPopup(
                        `<strong>${restaurant.name}</strong><br>      
                        <button onclick="window.location.href='${location.detailUrl}'">Voir le détail</button>`
                    ); // Ajout d'une popup avec le nom et le bouton`);
                }
            else {
                L.marker(latLng).addTo(map)
                    .bindPopup(
                        `<strong>${restaurant.name}</strong><br>`
                    );
            }
        }
    });
});