<?php


$scriptJS = 'script.js';


$sidebar = 'ok';


session_start();


// ! fichier init

require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';





try {
    // * modification du header
    $cssCategories = 'listCategories.css';
    $title = 'Consultation des catégories';

    // * pour afficher les catégories
    // $list = new Category(); // on a pas besoin d'hydrater l'objet donc on utilise la méthode static
    // $results = $list->getAll();
    $categories = Category::getAll();


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
include __DIR__ . '/../../../views/dashboard/categories/list.php';
include __DIR__ . '/../../../views/templates/dashboard/footer.php';