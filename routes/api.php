<?php

use App\Http\Controllers\CarsController;

const ROUTES = [
    [
        "uri" => "/vehicles",
        "method" => "GET",
        "controller" => CarsController::class,
        "function" => "index"
    ],
    [
        "uri" => "/vehicles/show",
        "method" => "GET",
        "controller" => CarsController::class,
        "function" => "show"
    ],
    [
        "uri" => "/vehicles/find",
        "method" => "GET",
        "controller" => CarsController::class,
        "function" => "search"
    ],
    [
        "uri" => "/vehicles",
        "method" => "POST",
        "controller" => CarsController::class,
        "function" => "store"
    ],
    [
        "uri" => "/vehicles/update",
        "method" => "POST",
        "controller" => CarsController::class,
        "function" => "update"
    ],
    [
        "uri" => "/vehicles/delete",
        "method" => "POST",
        "controller" => CarsController::class,
        "function" => "delete"
    ],
];