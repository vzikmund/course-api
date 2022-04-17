<?php

require_once "../vendor/autoload.php";

$api = new \Course\Api\Api();

Flight::route("POST /order", [$api, "createOrder"]);


Flight::route("GET /serial-number/@idRetailer:[0-9]+/@serialNumber:[0-9]+",
    [$api, "getOrderBySerialNumber"]);

Flight::route("GET /order-id/@idRetailer:[0-9]+/@idRetailerOrder",
    [$api, "getOrderByRetailerOrderId"]);


Flight::start();