<?php
require_once __DIR__ . '/../models/Vehicle.php';
require_once __DIR__ . '/../models/Category.php';


$categories = Category::getAll(); // je récupère la liste des catégories existante (voir boucle dans le HTML) => afficher la liste dans la vue


// var_dump($categories);
// die;
$title = 'Consulter les véhicules disponibles';
$scriptJS = 'script.js';



try {

    // ! pr afficher les véhicules
    $vehicles = Vehicle::getAll(1, false, true);




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


    // ! filtrer
    $id_category = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = [];
        // id_category
        $id_category = intval(filter_input(INPUT_POST, 'id_category', FILTER_SANITIZE_NUMBER_INT));
        if (empty($id_category)) {
            $error['id_category'] = 'Le champ ne peut pas être vide.';
        } else {
            $categoriesId = array_column($categories, 'id_category'); // création d'un tableau contenant les ID pour vérifier qu'un ID entré par un utilisateur corresponde bien à l'un des ID qui existent dans notre BDD

            $isOk = in_array($id_category, $categoriesId); // réponds true si l'id correspond bien à l'un de nos ID existant dans la BDD => pas besoin de filtre de validation
            // var_dump($id_category);
            // die;
            if (!$isOk) {
                $error['id_category'] = 'Erreur, le choix est invalide.';
            }
        }
    }



    $filterVehicles = Vehicle::filterVehicles($id_category);
    if (!empty($filterVehicles)) {
        $displayVehicles = $filterVehicles;
    }


} catch (\Throwable $th) {
    //throw $th;
}



// ! views

include __DIR__ . '/../views/templates/dashboard/header.php';
include __DIR__ . '/../views/frontVehicles/frontListVehicles.php';
include __DIR__ . '/../views/templates/dashboard/footer.php';
