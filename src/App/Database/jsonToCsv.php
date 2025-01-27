<?php
$path = ROOT . '/static/data/';
$jsonFile = $path . './restaurants_orleans.json';
$data = json_decode(file_get_contents($jsonFile), true);

// Open CSV files
$restaurantCsv = fopen($path . 'RESTAURANT.csv', 'w');
$typeCuisineCsv = fopen($path . 'TYPE_CUISINE.csv', 'w');
$faireCuisineCsv = fopen($path . 'FAIRE_CUISINE.csv', 'w');

// Write headers
fputcsv($restaurantCsv, ['id_restaurant', 'name', 'type', 'operator', 'brand', 'opening_hours', 'wheelchair', 'vegetarian', 'vegan', 'delivery', 'takeaway', 'internet_access', 'stars', 'capacity', 'drive_through', 'wikidata', 'brand_wikidata', 'siret', 'phone', 'website', 'facebook', 'smoking', 'com_insee', 'com_nom', 'region', 'code_region', 'departement', 'code_departement', 'commune', 'code_commune', 'latitude', 'longitude']);
fputcsv($typeCuisineCsv, ['id_cuisine', 'cuisine']);
fputcsv($faireCuisineCsv, ['id_restaurant', 'id_cuisine']);

$cuisines = [];
$types = [];
$faireCuisine = [];
$faireType = [];
$restaurants = [];

$id = 0;
foreach ($data as $item) {
    if (!empty($item['cuisine'])) {
        foreach ($item['cuisine'] as $cuisine) {
            if (!in_array(ucfirst($cuisine), $cuisines)) {
                // mettre la première lettre en majuscule
                $cuisine = ucfirst($cuisine);
                $cuisines[] = $cuisine;
            }
        }
    }

    $restaurants[] = [
        $id,
        $item['name'] ?? null,
        $item['type'] ?? null,
        $item['operator'] ?? null,
        $item['brand'] ?? null,
        $item['opening_hours'] ?? null,
        filter_boolean($item['wheelchair']),
        filter_boolean($item['vegetarian']),
        filter_boolean($item['vegan']),
        filter_boolean($item['delivery']),
        filter_boolean($item['takeaway']),
        is_array($item['internet_access']) ? implode(", ", $item['internet_access']) : ($item['internet_access'] ?? null),
        $item['stars'] ?? null,
        $item['capacity'] ?? null,
        filter_boolean($item['drive_through']),
        $item['wikidata'] ?? null,
        $item['brand_wikidata'] ?? null,
        $item['siret'] ?? null,
        $item['phone'] ?? null,
        $item['website'] ?? null,
        $item['facebook'] ?? null,
        filter_boolean($item['smoking']),
        $item['com_insee'] ?? null,
        $item['com_nom'] ?? null,
        $item['region'] ?? null,
        $item['code_region'] ?? null,
        $item['departement'] ?? null,
        $item['code_departement'] ?? null,
        $item['commune'] ?? null,
        $item['code_commune'] ?? null,
        $item['geo_point_2d']['lat'] ?? null,
        $item['geo_point_2d']['lon'] ?? null
    ];

    if (!empty($item['cuisine'])) {
        foreach ($item['cuisine'] as $cuisine) {
            $faireCuisine[] = [
                $id,
                array_search(ucfirst($cuisine), $cuisines)
            ];
        }
    }

    $id++;
}

foreach ($restaurants as $restaurant) {
    fputcsv($restaurantCsv, $restaurant);
}

foreach ($cuisines as $index => $cuisine) {
    fputcsv($typeCuisineCsv, [$index, $cuisine]);
}

foreach ($faireCuisine as $item) {
    fputcsv($faireCuisineCsv, $item);
}

fclose($restaurantCsv);
fclose($typeCuisineCsv);
fclose($faireCuisineCsv);

function filter_boolean($value) {
    if ($value === 'yes' || $value === 'Oui') {
        return 1; // true
    } elseif ($value === 'no' || $value === 'Non') {
        return 0; // false
    }
    return null; // Si ce n'est ni oui ni non
}

// function filter_boolean($value) {
//     return ($value === 'yes' || $value === 'Oui') ? 1 : 0;
// }
?>
