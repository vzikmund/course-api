<?php

require_once "../vendor/autoload.php";

Flight::route("GET /", function(){
    echo "hello from empty method";
});

Flight::route("GET|POST /first_route", function(){
    echo "hello from the first route";
});

Flight::route("POST /post_method", function(){
    echo "hello from post";
});

# POST
# GET
# PUT
# DELETE
# PATCH

Flight::start();