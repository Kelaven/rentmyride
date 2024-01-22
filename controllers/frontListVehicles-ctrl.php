<?php
require_once __DIR__ . '/../models/Vehicle.php';



$scriptJS = 'script.js';



try {

    // ! pr afficher l'ordre croissant ou décroissant
    $clickAscOrDesc = intval(filter_input(INPUT_GET, 'click', FILTER_SANITIZE_NUMBER_INT));
    // var_dump($clickAscOrDesc);

    if ($clickAscOrDesc === 2) {
        $vehicles = Vehicle::getAll($clickAscOrDesc, false, true);
    } else {
        $vehicles = Vehicle::getAll($clickAscOrDesc, false, true);
    }



    // ! pagination 
    // récupérer la valeur du paramètre page
    $page = intval(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT));
    if (isset($page) && (!empty($page))) {
        $currentPage = $page;
    } else {
        $currentPage = 1;
    }

    // déterminer le nombre de pages nécessaires pour avoir 8 véhicules par page
    $perPages = 8;

    $nbeVehicles = Vehicle::vehiclesCount();

    $nbePages = ceil($nbeVehicles / $perPages); // arrondit au nombre supérieur

    // calcul du premier véhicule de la page
    $firstVehicle = ($currentPage * $perPages) - $perPages; // le premier véhicule fait 0

    $displayVehicles = Vehicle::displayVehicles($firstVehicle, $perPages);
    // var_dump($displayVehicles);
    // die;


} catch (\Throwable $th) {
    //throw $th;
}



// ! views

include __DIR__ . '/../views/templates/dashboard/header.php';
include __DIR__ . '/../views/frontVehicles/frontListVehicles.php';
include __DIR__ . '/../views/templates/dashboard/footer.php';
