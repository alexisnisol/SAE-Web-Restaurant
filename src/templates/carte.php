<?php 
use App\Controllers\Restaurant\Restaurant;

$restaurant = Restaurant::getPosRestaurants();
?>

<div class="map">
    <!-- <h3>Les restaurants</h3> -->
    <div id="map"></div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script> 
<script src="./static/js/map.js"></script>

<script>
    let addresses = [
        <?php foreach ($restaurant as $resto) { ?>
            {
                lat: <?php echo $resto['latitude'] ?>, 
                lng: <?php echo $resto['longitude'] ?>, 
                name: "<?php echo $resto['name'] ?>", 
                detailUrl : "./index.php?action=visualisation&idRestau=<?php echo $resto['id_restaurant'] ?>"
            },
        <?php } ?>
    ];
</script>

