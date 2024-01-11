<?php

// ! fichier init

require_once __DIR__ . '/../../../config/init.php';


try {
    $cssVehicles = 'addVehicles.css';
    $title = 'Ajout d\'un véhicule';


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = [];
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
        $registration = filter_input(INPUT_POST, 'registration', FILTER_SANITIZE_NUMBER_INT); // nettoyage
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
            if (!$isOk) {
                $error['mileage'] = 'Le nom de kilomètres doit être de format : 12500.';
            }
        }
        // picture
        if (isset($_FILES['picture']) && ($_FILES['picture']['size'] != 0)) {
            try {
                if (!isset($_FILES['picture'])) {
                    throw new Exception("Le champ picture n'existe pas");
                }
                if ($_FILES['picture']['error'] != 0) {
                    throw new Exception("Une erreur est survenue lors du transfert");
                }
                if ($_FILES['picture']['type'] != 'image/png' && $_FILES['picture']['type'] != 'image/jpeg') {
                    throw new Exception("Ce fichier n'est pas au bon format");
                }
                if ($_FILES['picture']['size'] > MAX_FILESIZE) {
                    throw new Exception("Ce fichier est trop volumineux");
                }
                // Upload de l'image sur le serveur dans le bon dossier
                $from = $_FILES['picture']['tmp_name'];
                $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
                $filename = uniqid('picture_') . '.' . $extension;
                $to = __DIR__ . '/../../../public/uploads/users/' . $filename;
                move_uploaded_file($from, $to);
            } catch (\Throwable $th) {
                $error = $th->getMessage();
                echo $error;
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