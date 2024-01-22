<?php

require_once __DIR__ . '/../../../models/Vehicle.php';



session_start();


$sidebar = 'ok';
$scriptVehiclesJS = 'scriptVehicles.js';






try {

    // $archived = true; // on veut les archivés

    $isArchieved = intval(filter_input(INPUT_GET, 'id_vehicle', FILTER_SANITIZE_NUMBER_INT));

    if ($isArchieved) {
        // * archiver
        $archive = Vehicle::archive($isArchieved);

        $msg = 'La donnée a bien été archivée !';
        $_SESSION['msg'] = $msg;

        header('Location: /controllers/dashboard/vehicles/listVehicles-ctrl.php');  // si on reçoit un véhicule à archiver dans l'URL, pas besoin d'accèder à la vue
        die;
    }

    // * modification du header
    $cssReadVehicles = 'listVehicles.css';
    $title = 'Véhicules archivés';

    // * afficher les véhicules archivés
    $clickAscOrDesc = intval(filter_input(INPUT_GET, 'click', FILTER_SANITIZE_NUMBER_INT));

    if ($clickAscOrDesc === 2) {
        // $getArchiveds = Vehicle::getArchived($clickAscOrDesc);
        $getArchiveds = Vehicle::getAll($clickAscOrDesc, TRUE);

    } else {
        // $getArchiveds = Vehicle::getArchived($clickAscOrDesc);
        $getArchiveds = Vehicle::getAll($clickAscOrDesc, TRUE);

    }


    // * afficher le msg de suppression
    // $msg = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_SPECIAL_CHARS);
    $msg = filter_var($_SESSION['msg'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($_SESSION['msg'])) {
        unset($_SESSION['msg']); // une fois que le message a été affiché, on le retire de la session pour pas qu'il reste tout le temps)
    }






} catch (\Throwable $th) {
    echo "Erreur : " . $th->getMessage();
}






// ! views

include __DIR__ . '/../../../views/templates/dashboard/header.php';
include __DIR__ . '/../../../views/dashboard/vehicles/archiveVehicles.php';
// include __DIR__ . '/../../../views/dashboard/vehicles/listVehicles.php';
include __DIR__ . '/../../../views/templates/dashboard/footer.php';
