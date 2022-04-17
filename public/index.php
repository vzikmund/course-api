<?php

require_once "../vendor/autoload.php";

$logDirectory = "../log";
$loggerFactory = new \Course\Api\Logger\LoggerFactory($logDirectory);
$wrapperFactory = new \Course\Api\Wrapper\WrapperFactory($loggerFactory);
$api = new \Course\Api\Api($wrapperFactory);

Flight::route("POST /order", [$api, "createOrder"]);


Flight::route("GET /serial-number/@idRetailer:[0-9]+/@serialNumber:[0-9]+",
    [$api, "getOrderBySerialNumber"]);

Flight::route("GET /order-id/@idRetailer:[0-9]+/@idRetailerOrder",
    [$api, "getOrderByRetailerOrderId"]);


Flight::start();