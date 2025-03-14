<?php

namespace App\Controllers;

use App\Controllers\Restaurant\Restaurant;

class SearchController
{
    public static function search()
    {
        $query = $_GET['query'] ?? '';
        $type = $_GET['type'] ?? '';
        $results = Restaurant::searchByName($query, $type);

        header('Content-Type: application/json');
        send_response($results);
        echo json_encode($results);
    }
}

function send_response ($response, $code = 200) {
	http_response_code($code);
	die(json_encode($response));
}
