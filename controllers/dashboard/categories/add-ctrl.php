<?php


// ! fichier init

require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';

$sidebar = 'ok';


try {
    $cssCategories = 'addCategories.css';
    $title = 'Ajout d\'une catégorie';

    // ! Si le formulaire est envoyé
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // * nettoyage et validation du form
        $error = [];

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS); // filtre de nettoyage
        if (empty($name)) {
            $error['name'] = 'Le champ ne peut pas être vide';
        } else {
            $is_name_ok = filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_CATEGORY . '/'))); // filtre de validation
            if (!$is_name_ok) {
                $error['name'] = 'Le nom de la catégorie doit contenir 2 à 30 caractères alphabétiques et/ou numériques.';
            }
        }



        if (Category::isExist($name)) { // vérifier si la catégorie existe déjà, si la méthode retourne vrai
            $error['name'] = 'La donnée existe déjà';
        }




        if (empty($error)) {
            $category = new Category();
            $category->setName($name);

            $result = $category->insert();

            if ($result) {
                $msg = 'La donnée a bien été insérée ! Vous pouvez en saisir une autre.';
            } else {
                $msg = 'Erreur, la donnée n\'a pas été insérée. Veuillez réessayer.';
            }
        }
    }
} catch (Throwable $e) {
    echo "Erreur : " . $e->getMessage();
}





// ! views

include __DIR__ . '/../../../views/templates/dashboard/header.php';
include __DIR__ . '/../../../views/dashboard/categories/add.php';
include __DIR__ . '/../../../views/templates/dashboard/footer.php';
