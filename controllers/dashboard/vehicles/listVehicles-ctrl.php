<?php

$scriptVehiclesJS = 'scriptVehicles.js';
$sidebar = 'ok';


session_start();


// ! fichier init
// require_once __DIR__ . '/../../../models/Category.php';
require_once __DIR__ . '/../../../models/Vehicle.php';
// require_once __DIR__ . '/../../../config/init.php';



try {
    // $archived = false; // de base on est dans la list de vehicles de base donc on veut pas les archivés
    
    // * modification du header
    $cssReadVehicles = 'listVehicles.css';
    $title = 'Consultation des véhicules';
    
    // * pour afficher les véhicules
    $clickAscOrDesc = intval(filter_input(INPUT_GET, 'click', FILTER_SANITIZE_NUMBER_INT));
    // var_dump($clickAscOrDesc);

    // if ($clickAscOrDesc === 2) {
    //     $vehicles = Vehicle::getAll($clickAscOrDesc);
    // } else {
    //     $vehicles = Vehicle::getAll($clickAscOrDesc);
    // }

    if ($clickAscOrDesc === 2) { // si on veut afficher dans l'ordre décroissant
        $vehicles = Vehicle::getAll(clickAscOrDesc: $clickAscOrDesc);
    } else {
        $vehicles = Vehicle::getAll();
        // dd($vehicles);
    }


    // * afficher le msg d'archivage
    $msg = filter_var($_SESSION['msg'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($_SESSION['msg'])) {
        unset($_SESSION['msg']); // une fois que le message a été affiché, on le retire de la session pour pas qu'il reste tout le temps)
    }


} catch (\Throwable $th) {
    echo "Erreur : " . $th->getMessage();
}






// ! views

include __DIR__ . '/../../../views/templates/dashboard/header.php';
include __DIR__ . '/../../../views/dashboard/vehicles/listVehicles.php';
include __DIR__ . '/../../../views/templates/dashboard/footer.php';