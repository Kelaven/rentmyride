<?php
require_once __DIR__ . '/../models/Vehicle.php';

$scriptJS = 'script.js';



// // ! pr afficher les infos
// $vehicles = Vehicle::getAll($clickAscOrDesc);
// // var_dump($vehicles);

// ! pr afficher l'ordre croissant ou décroissant
$clickAscOrDesc = intval(filter_input(INPUT_GET, 'click', FILTER_SANITIZE_NUMBER_INT));
// var_dump($clickAscOrDesc);

if ($clickAscOrDesc === 2) {
    $vehicles = Vehicle::getAll($clickAscOrDesc);
} else {
    $vehicles = Vehicle::getAll($clickAscOrDesc);
}





// ! views

include __DIR__ . '/../views/templates/dashboard/header.php';
include __DIR__ . '/../views/frontVehicles/frontListVehicles.php';
include __DIR__ . '/../views/templates/dashboard/footer.php';