<?php

// ! fichier init

require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';
require_once __DIR__ . '/../../../models/Vehicle.php';


$categories = Category::getAll(); // je récupère la liste des catégories existante (voir boucle dans le HTML)


try {
    $cssVehicles = 'addVehicles.css';
    $title = 'Ajout d\'un véhicule';

    // * nettoyage et validation
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

            // * vérification si la donnée existe
            if (!empty($brand) && !empty($model) && !empty($registration) && !empty($mileage)) {
                if (Vehicle::isExist($brand, $model, $registration, $mileage, $id_category)) { // vérifier si la catégorie existe déjà, si la méthode retourne vrai
                    $error['isExist'] = 'La donnée existe déjà.';
                }
            }



        if (empty($error)) {

            // * envoi en BDD
            $vehicle = new Vehicle();

            $vehicle->setBrand($brand); // j'ai utilisé les setters mais j'aurais aussi pu utiliser la méthode magique construct
            $vehicle->setModel($model);
            $vehicle->setRegistration($registration);
            $vehicle->setMileage($mileage);
            // if (isset($picture)) { // j'ai pu retirer la condition en définissant "null" à $picture avant de traiter celle qui aurait été envoyée par l'utilisateur
                $vehicle->setPicture($picture);
            // }
            $vehicle->setIdCategory($id_category);

            $result = $vehicle->insert();

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
include __DIR__ . '/../../../views/dashboard/vehicles/addVehicles.php';
include __DIR__ . '/../../../views/templates/dashboard/footer.php';
