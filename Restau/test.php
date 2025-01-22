<?php
$jsonFile = './restaurants_orleans.json';
$data = json_decode(file_get_contents($jsonFile), true);

// Open CSV files
$restaurantCsv = fopen('./RESTAURANT.csv', 'w');
$typeRestaurantCsv = fopen('./TYPE_RESTAURANT.csv', 'w');
$typeCuisineCsv = fopen('./TYPE_CUISINE.csv', 'w');

// Write headers
fputcsv($restaurantCsv, ['id_restaurant', 'name', 'type', 'operator', 'brand', 'opening_hours', 'wheelchair', 'delivery', 'takeaway', 'internet_access', 'stars', 'capacity', 'drive_through', 'wikidata', 'brand_wikidata', 'siret', 'phone', 'website', 'facebook', 'smoking', 'com_insee', 'com_nom', 'region', 'code_region', 'departement', 'code_departement', 'commune', 'code_commune', 'latitude', 'longitude']);
fputcsv($typeRestaurantCsv, ['id_type', 'type']);
fputcsv($typeCuisineCsv, ['id_cuisine', 'cuisine']);

$id = 1;
foreach ($data as $item) {
    // RESTAURANT
    $restaurant = [
        $id,
        $item['name'],
        $item['type'],
        $item['operator'],
        $item['brand'],
        $item['opening_hours'],
        ($item['wheelchair'] === 'yes') ? TRUE : FALSE,
        ($item['delivery'] === 'yes') ? TRUE : FALSE,
        ($item['takeaway'] === 'yes') ? TRUE : FALSE,
        ($item['internet_access'] != null && $item['internet_access'][0] === 'yes') ? TRUE : FALSE,
        $item['stars'],
        $item['capacity'],
        ($item['drive_through'] === 'yes') ? TRUE : FALSE,
        $item['wikidata'],
        $item['brand_wikidata'],
        $item['siret'],
        $item['phone'],
        $item['website'],
        $item['facebook'],
        ($item['smoking'] === 'yes') ? TRUE : FALSE,
        $item['com_insee'],
        $item['com_nom'],
        $item['region'],
        $item['code_region'],
        $item['departement'],
        $item['code_departement'],
        $item['commune'],
        $item['code_commune'],
        $item['geo_point_2d']['lat'],
        $item['geo_point_2d']['lon']
    ];
    fputcsv($restaurantCsv, $restaurant);

    // TYPE_RESTAURANT
    fputcsv($typeRestaurantCsv, [$id, $item['type']]);

    // TYPE_CUISINE
    if (isset($item['cuisine'])) {
        foreach ($item['cuisine'] as $cuisine) {
            fputcsv($typeCuisineCsv, [$id, $cuisine]);
        }
    }

    $id++;
}

fclose($restaurantCsv);
fclose($typeRestaurantCsv);
fclose($typeCuisineCsv);
?>