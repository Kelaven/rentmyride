<?php

// ! fichier init

require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';





try {
    // modification du header
    $cssCategories = 'updateCategories.css';
    $title = 'Modification des catégories';

    $id_category = intval(filter_input(INPUT_GET, 'id_category', FILTER_SANITIZE_NUMBER_INT)); // récupérer la donnée tout en la nettoyant, ne pas utiliser $_GET. intval permet de retourner un entier dans tous les cas, 1 au lieu de "1"

    $category = Category::get($id_category); // on récupère toutes les propriétés de l'objet, issu de fetch (objet standard)
    // var_dump($category);
    if (!$category) { // si le résultat retourné est false
        header('Location: /controllers/dashboard/categories/list-ctrl.php');
        die;
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // * nettoyage et validation du form
        $error = [];
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS); // filtre de nettoyage
        if (empty($name)) {
            $error['name'] = 'Le champ ne peut pas être vide';
        } else {
            $is_name_ok = filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_CATEGORY . '/'))); // filtre de validation
            if (!$is_name_ok) {
                $error['name'] = 'Le nom de la catégorie doit contenir 2 à 30 caractères alphabétiques ou numériques.';
            }
        }



        if (Category::isExist($name)) { // vérifier si la catégorie existe déjà, si la méthode retourne vrai
            $error['name'] = 'La donnée existe déjà';
        }



        if (empty($error)) {

            $category = new Category();

            $category->setName($name);
            $category->setIdCategory($id_category);

            $result = $category->update();

            if ($result) {
                $msg = 'La donnée a bien été modifiée ! Vous allez être redirigé(e).';
                // header('Location: /controllers/dashboard/categories/list-ctrl.php');
                header("Refresh: 3, url='/controllers/dashboard/categories/list-ctrl.php'");
            } else {
                $msg = 'Erreur, la donnée n\'a pas été modifiée. Veuillez réessayer.';
            }
        }
    }
} catch (\Throwable $th) {
    echo "Erreur : " . $th->getMessage();
}


$category = Category::get($id_category); // je récupère mon objet avec toutes les modifications précédentes




// ! views

include __DIR__ . '/../../../views/templates/dashboard/header.php';
include __DIR__ . '/../../../views/dashboard/categories/update.php';
include __DIR__ . '/../../../views/templates/dashboard/footer.php';
