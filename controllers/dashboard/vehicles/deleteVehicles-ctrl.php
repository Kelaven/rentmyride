<?php
require_once __DIR__ . '/../../../models/Vehicle.php';

session_start();


try {
    $id_vehicle = intval(filter_input(INPUT_GET, 'id_vehicle', FILTER_SANITIZE_NUMBER_INT)); // récupérer la donnée tout en la nettoyant, ne pas utiliser $_GET. intval permet de retourner un entier dans tous les cas, 1 au lieu de "1"

    $delete = Vehicle::delete($id_vehicle);

    if ($delete) {

        
        $msg = 'La donnée a bien été supprimée !';
        $_SESSION['msg'] = $msg;
        

        header('Location: /controllers/dashboard/vehicles/listVehicles-ctrl.php');
        die;
    } else {
        $msg = 'La donnée n\'a pas été supprimée !';
    }


} catch (\Throwable $th) {
    echo "Erreur : " . $th->getMessage();
}


// ! views

include __DIR__ . '/../../../views/templates/dashboard/footer.php'; // pour le script