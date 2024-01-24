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


    // ! pagination 
    // récupérer la valeur du paramètre page
    $page = intval(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT));
    // récupérer la valeur du paramètre id_category en GET
    $id_categoryFilter = intval(filter_input(INPUT_GET, 'id_categoryFilter', FILTER_SANITIZE_NUMBER_INT));

    if (isset($page) && (!empty($page))) {
        $currentPage = $page;
    } else {
        $currentPage = 1;
    }


    $nbeVehicles = Vehicle::vehiclesCount();
    // déterminer le nombre de pages nécessaires pour avoir 8 véhicules par page
    // $perPages = 8; // NB_ELEMENTS_PER_PAGE, constant pour pouvoir la modifier facilement si besoin
    $nbePages = ceil($nbeVehicles / NB_ELEMENTS_PER_PAGE); // arrondit au nombre supérieur




    if (isset($page) && ($page < 0)) { // gérer l'erreur si l'utilisateur rentre un nombre de page négatif dans l'url
        $currentPage = 1;
    }
    if (isset($page) && ($page > $nbePages)) { // gérer l'erreur si l'utilisateur rentre un nombre de pages trop grand dans l'url
        $currentPage = $nbePages;
    }


    // calcul du premier véhicule de la page perPages: true
    $firstVehicle = ($currentPage * NB_ELEMENTS_PER_PAGE) - NB_ELEMENTS_PER_PAGE; // le premier véhicule fait 0

    // $displayVehicles = Vehicle::displayVehicles($firstVehicle, NB_ELEMENTS_PER_PAGE); // pour l'instant l'utilisateur n'a pas encore choisit le filtre donc je ne précise pas le troisième argument

    $vehicles = Vehicle::getAll(firstVehicle: $firstVehicle, perPages: true);

    // var_dump($displayVehicles);
    // die;









    // ! filtrer
    $id_category = null;
    $id_category = intval(filter_input(INPUT_GET, 'id_category', FILTER_SANITIZE_NUMBER_INT));



    // ? Recherche de véhicule
    // récupérer la valeur du paramètre
    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
    if ($search !== false) {
        // dd($search);
        $vehicles = Vehicle::getAll(search: $search);
        // dd($vehicles);
    }


    // * je recompte les véhicules si l'utilisateur a choisi un filtre pour adapter la pagination au filtre
    $nbeVehicles = Vehicle::vehiclesCount($id_category);
    // dd($nbeVehicles);
    $nbePages = ceil($nbeVehicles / NB_ELEMENTS_PER_PAGE); // arrondit au nombre supérieur
    if (isset($page) && ($page < 0)) { // gérer l'erreur si l'utilisateur rentre un nombre de page négatif dans l'url
        $currentPage = 1;
    }
    if (isset($page) && ($page > $nbePages)) { // gérer l'erreur si l'utilisateur rentre un nombre de pages trop grand dans l'url
        $currentPage = $nbePages;
    }
    // d($id_categoryFilter);

    $vehicles = Vehicle::getAll(firstVehicle: $firstVehicle, perPages: true, id_category: $id_category); // pour filtrer si l'utiliser en a choisit un donc en récupérant l'id du filtre choisit 






} catch (\Throwable $th) {
    //throw $th;
}



// ! views

include __DIR__ . '/../views/templates/dashboard/header.php';
include __DIR__ . '/../views/frontVehicles/frontListVehicles.php';
include __DIR__ . '/../views/templates/dashboard/footer.php';
