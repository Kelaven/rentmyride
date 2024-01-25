<?php
require_once __DIR__ . '/../models/Vehicle.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../helpers/dd.php';
require_once __DIR__ . '/../config/init.php';







try {
    $title = 'Consulter les véhicules disponibles';
    $scriptJS = 'script.js';



    // ! filter
    $page = intval(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT));

    $id_category = intval(filter_input(INPUT_GET, 'id_category', FILTER_SANITIZE_NUMBER_INT));

    $search = (string) filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS);



    $categories = Category::getAll(); // je récupère la liste des catégories existante (voir boucle dans le HTML) => afficher la liste dans la vue



    
    $vehicles = Vehicle::getAll(perPages: false, id_category: $id_category, search: $search);
    $nbeVehicles = count($vehicles);

    $nbePages = ceil($nbeVehicles / NB_ELEMENTS_PER_PAGE); 
    if ($page <= 0 || $page > $nbePages) { 
        $page = 1;
    }
    

    // calcul du premier véhicule de la page perPages: true
    $firstVehicle = ($page * NB_ELEMENTS_PER_PAGE) - NB_ELEMENTS_PER_PAGE; // le premier véhicule fait 0


    $vehicles = Vehicle::getAll(firstVehicle: $firstVehicle, perPages: true, id_category: $id_category, search: $search);


} catch (\Throwable $th) {
    dd($th);
}



// ! views

include __DIR__ . '/../views/templates/dashboard/header.php';
include __DIR__ . '/../views/frontVehicles/frontListVehicles.php';
include __DIR__ . '/../views/templates/dashboard/footer.php';
