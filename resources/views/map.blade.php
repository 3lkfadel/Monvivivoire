<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte des Produits Locaux</title>
    <!-- Lien vers la feuille de style de Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>

<div id="map"></div>

<!-- Lien vers la bibliothèque Leaflet -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([7.54, -5.85], 6); // Coordonnées initiales (ici pour la Côte d'Ivoire)

    // Ajouter une couche de carte (par exemple OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Exemple d'ajout d'un marqueur (ici pour Abidjan)
    L.marker([5.31, -4.03]).addTo(map)
        .bindPopup('Abidjan: Produits locaux disponibles!')
        .openPopup();
// Fonction pour récupérer les produits locaux en fonction de la localisation
function getLocalProducts(location) {
    // Utilise AJAX pour récupérer les produits locaux basés sur la localisation
    fetch(`/api/products/location/${location}`)
        .then(response => response.json())
        .then(data => {
            // Affiche les informations sur la carte ou dans une fenêtre modale
            console.log(data);
        })
        .catch(error => console.error('Error:', error));
}

// Exemple d'une zone cliquable ou d'un survol de la carte
L.polygon([
    [5.31, -4.03], // coordonnée pour une zone géographique
    [5.32, -4.02],
    [5.31, -4.01]
])
.addTo(map)
.on('mouseover', function() {
    // Quand l'utilisateur survole la zone, récupère les produits pour cette localisation
    getLocalProducts('Abidjan'); // Passe ici la localisation comme chaîne (par exemple "Abidjan")
})
.bindPopup("Zone d'Abidjan");

</script>

</body>
</html>
