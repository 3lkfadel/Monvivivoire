<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte des Produits Locaux</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap" async defer></script>
</head>
<body>

<div id="map"></div>

<script>
// Initialisation de la carte
function initMap() {
    var mapOptions = {
        center: { lat: 7.54, lng: -5.85 }, // Coordonnées initiales pour la Côte d'Ivoire
        zoom: 6
    };

    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    // Exemple d'ajout d'un marqueur pour Abidjan
    var marker = new google.maps.Marker({
        position: { lat: 5.31, lng: -4.03 },
        map: map,
        title: 'Abidjan: Produits locaux disponibles!'
    });

    // Ajouter un infobulle au marqueur
    var infowindow = new google.maps.InfoWindow({
        content: 'Abidjan: Produits locaux disponibles!'
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

    // Fonction pour récupérer les produits locaux en fonction de la localisation
    function getLocalProducts(location) {
        fetch(`/api/products/location/${location}`)
            .then(response => response.json())
            .then(data => {
                // Afficher les informations sur la carte ou dans une fenêtre modale
                console.log(data);
                // Tu peux ajouter des marqueurs pour les produits locaux ici
                data.forEach(product => {
                    // Exemple d'ajout d'un marqueur pour chaque produit
                    var productMarker = new google.maps.Marker({
                        position: { lat: product.latitude, lng: product.longitude },
                        map: map,
                        title: product.name
                    });

                    productMarker.addListener('click', function() {
                        var productInfo = new google.maps.InfoWindow({
                            content: product.name + ': ' + product.description
                        });
                        productInfo.open(map, productMarker);
                    });
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Exemple de zone cliquable (par exemple pour Abidjan)
    var abidjanBounds = new google.maps.Polygon({
        paths: [
            { lat: 5.31, lng: -4.03 },
            { lat: 5.32, lng: -4.02 },
            { lat: 5.31, lng: -4.01 }
        ],
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35
    });

    abidjanBounds.setMap(map);

    // Événement survol de la zone
    google.maps.event.addListener(abidjanBounds, 'mouseover', function() {
        // Quand l'utilisateur survole la zone, récupérer les produits locaux pour Abidjan
        getLocalProducts('Abidjan');
    });

    // Événement sortie de la zone
    google.maps.event.addListener(abidjanBounds, 'mouseout', function() {
        // Optionnel : retirer les produits locaux ou marquer les produits visibles
    });
}
</script>

</body>
</html>
