<?php

require_once "../vendor/autoload.php";


Flight::route("POST /order", function(){
    $id = Flight::request()->data->order_id;
    echo "im creating a new order ID {$id}";
});


Flight::route("GET /serial-number/@idRetailer:[0-9]+/@serialNumber:[0-9]+",
    function($idRetailer, $serialNumber){
    echo "getting an order for retailer {$idRetailer} by its serial number {$serialNumber}";
});

Flight::route("GET /order-id/@idRetailer:[0-9]+/@idRetailerOrder",
    function($idRetailer, $idRetailerOrder){
    echo "getting an order for retailer ID {$idRetailer} by its retailer order id {$idRetailerOrder}";
});



Flight::start();