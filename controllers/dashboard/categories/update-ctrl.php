<?php

// ! fichier init

require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';





try {
    // modification du header
    $css = 'updateCategories.css';
    $title = 'Modification des catégories';

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // * nettoyage et validation du form
        $error = [];
        // pour ajouter une catégorie :
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS); // filtre de nettoyage
        if (empty($name)) {
            $error['name'] = 'Le champ ne peut pas être vide';
        } else {
            $is_name_ok = filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_CATEGORY . '/'))); // filtre de validation
            if (!$is_name_ok) {
                $error['name'] = 'Le nom de la catégorie doit contenir 2 à 30 caractères alphabétiques ou numériques.';
            }
        }





        if (empty($error)) {
            $category = new Category();
            // $category->setName($name);
            // $result = $category->insert();

            if ($result) {
                $msg = 'La donnée a bien été modifiée !';
            } else {
                $msg = 'Erreur, la donnée n\'a pas été modifiée. Veuillez réessayer.';
            }
        }
    }




    $categories = Category::getAll();
    

} catch (\Throwable $th) {
    echo "Erreur : " . $th->getMessage();
}






// ! views

include __DIR__ . '/../../../views/templates/dashboard/header.php';
include __DIR__ . '/../../../views/dashboard/categories/update.php';
include __DIR__ . '/../../../views/templates/dashboard/footer.php';