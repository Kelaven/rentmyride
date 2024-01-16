<?php

// ! fichier init

require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';
require_once __DIR__ . '/../../../models/Vehicle.php';



$categories = Category::getAll(); // je récupère la liste des catégories existante (voir boucle dans le HTML)



try {
    // modification du header
    $cssUpdateVehicles = 'updateVehicles.css';
    $title = 'Modification des véhicules';

    // $id_category = intval(filter_input(INPUT_GET, 'id_category', FILTER_SANITIZE_NUMBER_INT)); // récupérer la donnée tout en la nettoyant, ne pas utiliser $_GET. intval permet de retourner un entier dans tous les cas, 1 au lieu de "1"

    // $category = Category::get($id_category); // on récupère toutes les propriétés de l'objet, issu de fetch (objet standard)
    // // var_dump($category);
    // if (!$category) { // si le résultat retourné est false
    //     header('Location: /controllers/dashboard/categories/list-ctrl.php');
    //     die;
    // }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // * nettoyage et validation du form
        $error = [];
        // id_category
        $id_category = filter_input(INPUT_POST, 'id_category', FILTER_SANITIZE_NUMBER_INT);
        if (empty($id_category)) {
            $error['id_category'] = 'Le champ ne peut pas être vide.';
        } else {
            $categoriesId = array_column($categories, 'id_category'); // création d'un tableau contenant les ID pour vérifier qu'un ID entré par un utilisateur corresponde bien à l'un des ID qui existent dans notre BDD
            $isOk = in_array($id_category, $categoriesId); // réponds true si l'id correspond bien à l'un de nos ID existant dans la BDD => pas besoin de filtre de validation
            if (!$isOk) {
                $error['id_category'] = 'Erreur, le choix est invalide.';
            }
        }
        // brand
        $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_SPECIAL_CHARS); // nettoyage
        if (empty($brand)) {
            $error['brand'] = 'Le champ ne peut pas être vide';
        } else {
            $isOk = filter_var($brand, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_CATEGORY . '/')));
            if (!$isOk) {
                $error['brand'] = 'La marque doit contenir 2 à 30 caractères alphabétiques et/ou numériques.';
            }
        }
        // model
        $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_SPECIAL_CHARS); // nettoyage
        if (empty($model)) {
            $error['model'] = 'Le champ ne peut pas être vide';
        } else {
            $isOk = filter_var($model, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_MODEL . '/')));
            if (!$isOk) {
                $error['model'] = 'Le modèle doit contenir 1 à 30 caractères alphabétiques et/ou numériques.';
            }
        }
        // registration
        $registration = filter_input(INPUT_POST, 'registration', FILTER_SANITIZE_SPECIAL_CHARS); // nettoyage
        if (empty($registration)) {
            $error['registration'] = 'Le champ ne peut pas être vide';
        } else {
            $isOk = filter_var($registration, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_REGISTRATION . '/')));
            if (!$isOk) {
                $error['registration'] = 'La plaque d\'immatriculation doit être de format AA-111-AA ou 1111-AA-11.';
            }
        }
        // mileage
        $mileage = filter_input(INPUT_POST, 'mileage', FILTER_SANITIZE_NUMBER_INT); // nettoyage
        if (empty($mileage)) {
            $error['mileage'] = 'Le champ ne peut pas être vide';
        } else {
            $isOk = filter_var($mileage, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_MILEAGE . '/')));
            if (!$isOk || $isOk > 1500000) { // ne pas accepter un nombre de Kms > 1M5
                $error['mileage'] = 'Le nombre de kilomètres est invalide.';
            }
        }
        // picture
        $picture = null;
        if (isset($_FILES['picture']) && ($_FILES['picture']['size'] != 0)) {
            try {
                if (!isset($_FILES['picture'])) {
                    throw new Exception("Le champ picture n'existe pas.");
                }
                if ($_FILES['picture']['error'] != 0) {
                    throw new Exception("Une erreur est survenue lors du transfert.");
                }
                if (!in_array($_FILES['picture']['type'], ARRAY_TYPES)) {
                    throw new Exception("Ce fichier n'est pas au bon format.");
                }
                if ($_FILES['picture']['size'] > MAX_FILESIZE) {
                    throw new Exception("Ce fichier est trop volumineux.");
                }
                // Upload de l'image sur le serveur dans le bon dossier
                $from = $_FILES['picture']['tmp_name'];
                $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
                $filename = uniqid('picture_') . '.' . $extension;
                $to = __DIR__ . '/../../../public/uploads/users/' . $filename;
                move_uploaded_file($from, $to);
                $picture = $filename; // pour n'envoyer en BDD que le nom du fichier et pas le chemin (important sinon on reçoit NULL en BDD)
            } catch (\Throwable $th) {
                $error['picture'] = $th->getMessage();
            }
        }



        // if (Vehicle::isExist($brand, $model, $registration, $mileage, $categoriesId)) { // vérifier si la catégorie existe déjà, si la méthode retourne vrai
        //     $error['isExist'] = 'La donnée existe déjà';
        // }



        if (empty($error)) {

            $vehicle = new Vehicle();

            $vehicle->setBrand($brand);
            $vehicle->setModel($model);
            $vehicle->setRegistration($registration);
            $vehicle->setMileage($mileage);
            $vehicle->setPicture($picture);
            $vehicle->setIdCategory($id_category);

            $result = $vehicle->update();

            if ($result) {
                $msg = 'La donnée a bien été modifiée ! Vous allez être redirigé(e).';
                header("Refresh: 3, url='/controllers/dashboard/vehicles/listVehicles-ctrl.php'");
            } else {
                $msg = 'Erreur, la donnée n\'a pas été modifiée. Veuillez réessayer.';
            }
        }
    }
} catch (\Throwable $th) {
    echo "Erreur : " . $th->getMessage();
}


// $category = Category::get($id_category); // je récupère mon objet avec toutes les modifications précédentes



// ! views

include __DIR__ . '/../../../views/templates/dashboard/header.php';
include __DIR__ . '/../../../views/dashboard/vehicles/updateVehicles.php';
include __DIR__ . '/../../../views/templates/dashboard/footer.php';
