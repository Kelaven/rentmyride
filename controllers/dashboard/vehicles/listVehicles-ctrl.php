<?php

$scriptVehiclesJS = 'scriptVehicles.js';


session_start();


// ! fichier init

require_once __DIR__ . '/../../../models/Vehicle.php';



try {
    // * modification du header
    $cssReadVehicles = 'listVehicles.css';
    $title = 'Consultation des véhicules';

    // * pour afficher les véhicules
    $vehicles = Vehicle::getAll();
    // var_dump($vehicles);


    // * afficher le msg de suppression
    // $msg = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_SPECIAL_CHARS);
    // var_dump($msg);

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