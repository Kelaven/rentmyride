<?php

require_once __DIR__ . '/../../../models/Vehicle.php';



session_start();



try {
    $archived = intval(filter_input(INPUT_GET, 'id_vehicle', FILTER_SANITIZE_NUMBER_INT));

    if ($archived) {
        // * désarchiver
        $archive = Vehicle::unarchive($archived);

        $msg = 'La donnée a bien été désarchivée !';
        $_SESSION['msg'] = $msg;

        header('Location: /controllers/dashboard/vehicles/archiveVehicles-ctrl.php');  // si on reçoit un véhicule à archiver dans l'URL, pas besoin d'accèder à la vue
        die;
    }



    // * afficher le msg de désachivage
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
include __DIR__ . '/../../../views/templates/dashboard/footer.php';
