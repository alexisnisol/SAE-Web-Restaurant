document.addEventListener("DOMContentLoaded", function () {
    // Initialisation de la carte et centrage sur la France
    const France = {pos: [46.903354, 1.888334], zoom: 5};
    const Orléans = {pos: [47.880999, 1.909251], zoom: 12};
    let view = addresses.length > 1 ? Orléans : France;
    var map = L.map('map').setView(view.pos, view.zoom); 

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
                        <button class="name" onclick="window.location.href='${restaurant.detailUrl}'">Voir le détail</button>`
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