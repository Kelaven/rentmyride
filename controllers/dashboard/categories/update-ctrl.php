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

            $pdo = Database::connect();

        // $sql = 'SELECT * FROM `categories`
        //     WHERE id = :name';

        // // $sql = "UPDATE `categories`
        // // SET `name`= (:name)
        // // WHERE `id_category` = 15;";

        // $sth = $pdo->prepare($sql);

        // $sth->bindValue(':name', $_POST['name'], PDO::PARAM_STR); // car l'utilisateur rentre de nouveau une donnée, je la récupère sous form d'entier (son id)

        // $execute = $sth->execute();

        // $updates = $sth->fetch(PDO::FETCH_OBJ);
        // var_dump($updates);

        $name = Category::getAll();
        var_dump($name);





            // if ($result) {
            //     $msg = 'La donnée a bien été modifiée !';
            // } else {
            //     $msg = 'Erreur, la donnée n\'a pas été modifiée. Veuillez réessayer.';
            // }
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