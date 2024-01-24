<?php
require_once __DIR__ . '/../models/Vehicle.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../helpers/dd.php';
require_once __DIR__ . '/../config/init.php';

$categories = Category::getAll(); // je récupère la liste des catégories existante (voir boucle dans le HTML) => afficher la liste dans la vue


// var_dump($categories);
// die;
$title = 'Consulter les véhicules disponibles';
$scriptJS = 'script.js';



try {

    // ! pr afficher les véhicules
    // $vehicles = Vehicle::getAll(1, false, true);
    // $vehicles = Vehicle::getAll2(); // j'affiche les véhicules en les paginant 
    // dd($vehicles);





    // ! pagination 
    // récupérer la valeur du paramètre page
    $page = intval(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT));
    if (isset($page) && (!empty($page))) {
        $currentPage = $page;
    } else {
        $currentPage = 1;
    }


    $nbeVehicles = Vehicle::vehiclesCount();
    // déterminer le nombre de pages nécessaires pour avoir 8 véhicules par page
    // $perPages = 8; // NB_ELEMENTS_PER_PAGE, constant pour pouvoir la modifier facilement si besoin
    $nbePages = ceil($nbeVehicles / NB_ELEMENTS_PER_PAGE); // arrondit au nombre supérieur




    if (isset($page) && ($page<0)) { // gérer l'erreur si l'utilisateur rentre un nombre de page négatif dans l'url
        $currentPage = 1;
    }
    if (isset($page) && ($page>$nbePages)) { // gérer l'erreur si l'utilisateur rentre un nombre de pages trop grand dans l'url
        $currentPage = $nbePages;
    }


    // calcul du premier véhicule de la page perPages: true
    $firstVehicle = ($currentPage * NB_ELEMENTS_PER_PAGE) - NB_ELEMENTS_PER_PAGE; // le premier véhicule fait 0

    // $displayVehicles = Vehicle::displayVehicles($firstVehicle, NB_ELEMENTS_PER_PAGE); // pour l'instant l'utilisateur n'a pas encore choisit le filtre donc je ne précise pas le troisième argument
    
    $vehicles = Vehicle::getAll2(firstVehicle: $firstVehicle, perPages: true);
    
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


    $displayVehicles = Vehicle::displayVehicles($firstVehicle, NB_ELEMENTS_PER_PAGE, $id_category); // pour filtrer si l'utiliser en a choisit un donc en récupérant l'id du filtre choisit 
    // $vehicles = Vehicle::getAll2(firstVehicle: $firstVehicle, perPages: true, )


} catch (\Throwable $th) {
    //throw $th;
}



// ! views

include __DIR__ . '/../views/templates/dashboard/header.php';
include __DIR__ . '/../views/frontVehicles/frontListVehicles.php';
include __DIR__ . '/../views/templates/dashboard/footer.php';
