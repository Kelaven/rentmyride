<?php

// ! fichier init

require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';
require_once __DIR__ . '/../../../models/Vehicle.php';

$sidebar = 'ok';

// $vehicles = Vehicle::getAll();


try {
    $categories = Category::getAll(); // je récupère la liste des catégories existante (voir boucle dans le HTML) => afficher la liste dans la vue
    // modification du header
    $cssUpdateVehicles = 'updateVehicles.css';
    $title = 'Modification des véhicules';

    $id_vehicle = intval(filter_input(INPUT_GET, 'id_vehicle', FILTER_SANITIZE_NUMBER_INT)); // récupérer la donnée tout en la nettoyant, ne pas utiliser $_GET. intval permet de retourner un entier dans tous les cas, 1 au lieu de "1"

    $vehicle = Vehicle::get($id_vehicle); // récupérer les infos avant leur entrée dans la BDD, nécessaire pour la méthode isExist

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // * nettoyage et validation du form
        $error = [];
        // id_category
        $id_category = intval(filter_input(INPUT_POST, 'id_category', FILTER_SANITIZE_NUMBER_INT));
        if (empty($id_category)) {
            $error['id_category'] = 'Le champ ne peut pas être vide.';
        } else {
            $categoriesId = array_column($categories, 'id_category'); // création d'un tableau contenant les ID pour vérifier qu'un ID entré par un utilisateur corresponde bien à l'un des ID qui existent dans notre BDD
            // var_dump($categoriesId);
            // die;
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
        $mileage = intval(filter_input(INPUT_POST, 'mileage', FILTER_SANITIZE_NUMBER_INT)); // nettoyage
        if (empty($mileage)) {
            $error['mileage'] = 'Le champ ne peut pas être vide';
        } else {
            $isOk = filter_var($mileage, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_MILEAGE . '/')));
            if (!$isOk || $isOk > 1500000) { // ne pas accepter un nombre de Kms > 1M5
                $error['mileage'] = 'Le nombre de kilomètres est invalide.';
            }
        }
        // picture
        $picture = $vehicle->picture;
        if (!empty($_FILES['picture']['name'])) { // si l'utilisateur rentre une image dans le formulaire
            try {
                @unlink(__DIR__ . '/../../../public/uploads/users/' . $picture); // supprime l'image du disque si on la modifie par une autre
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
                $from = $_FILES['picture']['tmp_name']; // chemin temporaire où a été déposée la photo
                $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION); // pathinfo_exrtensions pour récupérer l'extension du fichier uniquement (et pas en plus de ça le MIME etc)
                $picture = uniqid('picture_') . '.' . $extension;
                $to = __DIR__ . '/../../../public/uploads/users/' . $picture;
                move_uploaded_file($from, $to);
                // $picture = $filename; // pour n'envoyer en BDD que le nom du fichier et pas le chemin (important sinon on reçoit NULL en BDD)
            } catch (\Throwable $th) {
                $error['picture'] = $th->getMessage();
            }
        } 
        // else {
        //     $existingPicture = Vehicle::getPictureUpdate($id_vehicle); // sinon si l'utilisateur n'en rentre pas et qu'il en existe déjà une dans la BDD => récupérer la photo existante du véhicule
        //     // var_dump($existingPicture);
        //     if (!empty($existingPicture)) { // s'il y a bien une image en BDD
        //         $picture = $existingPicture->picture;
        //     }
        // }



        if ((Vehicle::isExist($registration)) && ($registration != $vehicle->registration)) { // si la plaque existe en base et si la plaque rentrée par l'utilisateur est différente de celle qu'il y avait en base
            // En résumé, cette ligne de code vérifie si la plaque d'immatriculation entrée par l'utilisateur existe déjà dans la base de données et si elle est différente de celle qui est actuellement associée au véhicule. Si ces conditions sont remplies, une erreur est enregistrée pour informer l'utilisateur que la plaque d'immatriculation existe déjà.
            // Bref, si la plaque rentrée par l'utilisateur est la même que celle associé au véhicule actuel, ça fonctionne (pour pouvoir modifier par exemple le kilométrage mais pas la plaque). Par contre si c'est la même qu'une autre plaque existante dans un autre véhicule de la BDD, ça fonctionnera pas. 
            $error['isExist'] = 'La plaque d\'immatriculation existe déjà';
        } 


        if (empty($error)) {

            $vehicle = new Vehicle(); // objet issu d'une classe donc privé (car utilisation de private)
            // var_dump($vehicle);

            $vehicle->setBrand($brand);
            $vehicle->setModel($model);
            $vehicle->setRegistration($registration);
            $vehicle->setMileage($mileage);
            $vehicle->setPicture($picture);
            $vehicle->setIdVehicle($id_vehicle);
            $vehicle->setIdCategory($id_category);

            $result = $vehicle->update();


            if ($result) {
                $msg = 'La donnée a bien été modifiée ! Vous allez être redirigé(e).';
                header("Refresh: 3, url='/controllers/dashboard/vehicles/listVehicles-ctrl.php'");
                // die;
            } else {
                $msg = 'Erreur, la donnée n\'a pas été modifiée. Veuillez réessayer.';
            }
        }
    }

    $vehicle = Vehicle::get($id_vehicle); // ! on récupère toutes les propriétés de l'objet après son hydratation, issu de fetch (méthode public) => mémoriser les données pour les afficher dans la vue. De plus, il faut bien utiliser les informations après leur bon enregistrement dans la BDD.


    if (!$vehicle) { // si le résultat retourné est false
        header('Location: /controllers/dashboard/vehicles/listVehicles-ctrl.php');
        die;
    }
} catch (\Throwable $th) {
    echo "Erreur : " . $th->getMessage();
}


// $category = Category::get($id_category); // je récupère mon objet avec toutes les modifications précédentes



// ! views

include __DIR__ . '/../../../views/templates/dashboard/header.php';
include __DIR__ . '/../../../views/dashboard/vehicles/updateVehicles.php';
include __DIR__ . '/../../../views/templates/dashboard/footer.php';
