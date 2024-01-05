<?php

// $host = 'localhost';
// $dbname = 'rentmyride';
// $username = 'rentmyride_admin';
// $password = '2t9#csRh$%uQ^wWPaFTb';

// ! fichier init

require_once __DIR__.'/../../../config/init.php';




// ! nettoyage et validation du form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = [];
    // * ajouter une catégorie
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS); // filtre de nettoyage
    $is_name_ok = filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/'.REGEX_CATEGORY.'/'))); // filtre de validation
    if (!$is_name_ok) {
        $error['name'] = 'Le nom de la catégorie doit contenir 2 à 30 caractères alphabétiques.';
    }
    if ($error == []) {
        $result = 'La donnée a bien été envoyée !';
    }
}



// ! views

include __DIR__.'/../../../views/templates/dashboard/header.php';
include __DIR__.'/../../../views/dashboard/categories/add.php';
include __DIR__.'/../../../views/templates/dashboard/footer.php';