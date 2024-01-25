<?php

require_once __DIR__ . '/../helpers/dd.php';
require_once __DIR__ . '/../config/init.php';




try {
    $title = 'Réservation de véhicule';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = [];
        //===================== Startdate : Nettoyage et validation =======================
        $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_NUMBER_INT);
        if (!empty($startdate)) {
            $isOk = filter_var($startdate, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
            if (!$isOk) {
                $error["startdate"] = "La date entrée n'est pas valide!";
            }
        } else {
            $error["startdate"] = "La date de début de réservation est obligatoire!!";
        }
        //===================== Enddate : Nettoyage et validation =======================
        $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_NUMBER_INT);
        if (!empty($enddate)) {
            $isOk = filter_var($enddate, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
            if (!$isOk) {
                $error["enddate"] = "La date entrée n'est pas valide!";
            }
        } else {
            $error["enddate"] = "La date de fin de réservation est obligatoire!!";
        }
        //===================== Lastname : Nettoyage et validation =======================
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($lastname)) {
            $error["lastname"] = "Vous devez entrer un nom!!";
        } else { // Pour les champs obligatoires, on retourne une erreur
            $isOk = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
            if (!$isOk) {
                $error["lastname"] = "Le nom n'est pas au bon format!!";
            } else {
                // Dans ce cas précis, on vérifie aussi la longueur de chaine (on aurait pu le faire aussi direct dans la regex)
                if (strlen($lastname) <= 2 || strlen($lastname) >= 70) {
                    $error["lastname"] = "La longueur du nom n'est pas valide";
                }
            }
        }
        //===================== Firstname : Nettoyage et validation =======================
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($firstname)) {
            $error["firstname"] = "Vous devez entrer un nom!!";
        } else { // Pour les champs obligatoires, on retourne une erreur
            $isOk = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
            if (!$isOk) {
                $error["firstname"] = "Le nom n'est pas au bon format!!";
            } else {
                // Dans ce cas précis, on vérifie aussi la longueur de chaine (on aurait pu le faire aussi direct dans la regex)
                if (strlen($firstname) <= 2 || strlen($firstname) >= 70) {
                    $error["firstname"] = "La longueur du prénom n'est pas valide";
                }
            }
        }
        //===================== email : Nettoyage et validation =======================
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (empty($email)) {
            $error["email"] = "L'adresse mail est obligatoire!!";
        } else {
            $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$testEmail) {
                $error["email"] = "L'adresse email n'est pas au bon format!!";
            }
        }
        //===================== birthday : Nettoyage et validation =======================
        $birthday = filter_input(INPUT_POST, 'birthday', FILTER_SANITIZE_NUMBER_INT);
        if (!empty($birthday)) {
            $isOk = filter_var($birthday, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/' . REGEX_DATE . '/']]);
            if (!$isOk) {
                $error["birthday"] = "La date entrée n'est pas valide!";
            } else {
                $birthdayObj = new DateTime($birthday);
                // Calcul de l'age de l'utilisateur (année courante - année de naissance)
                $age = date('Y') - $birthdayObj->format('Y');

                if ($age > 120 || $age < 0) {
                    $error[""] = "Votre age n'est pas conforme!";
                }
            }
        } else {
            $error["birthday"] = "La date de naissance est obligatoire!!";
        }
        //===================== Phone : Nettoyage et validation =======================
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
        if (empty($phone)) {
            $error["phone"] = "Vous devez entrer un numéro de téléphone!!";
        } else { // Pour les champs obligatoires, on retourne une erreur
            $isOk = filter_var($phone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PHONE . '/')));
            if (!$isOk) {
                $error["phone"] = "Le numéro de téléphone n'est pas au bon format!!";
            }
        }
        //===================== City : Nettoyage et validation =======================
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($city)) {
            $error["city"] = "Vous devez entrer une ville!!";
        } else { // Pour les champs obligatoires, on retourne une erreur
            $isOk = filter_var($city, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NO_NUMBER . '/')));
            if (!$isOk) {
                $error["city"] = "La ville n'est pas au bon format!!";
            } else {
                // Dans ce cas précis, on vérifie aussi la longueur de chaine (on aurait pu le faire aussi direct dans la regex)
                if (strlen($city) <= 2 || strlen($city) >= 70) {
                    $error["city"] = "La longueur de la ville n'est pas valide";
                }
            }
        }
        //===================== Zipcode : Nettoyage et validation =======================
        $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_NUMBER_INT);
        if (empty($zipcode)) {
            $error["zipcode"] = "Vous devez entrer un code postal!!";
        } else { // Pour les champs obligatoires, on retourne une erreur
            $isOk = filter_var($zipcode, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_ZIPCODE . '/')));
            if (!$isOk) {
                $error["zipcode"] = "Le code postal n'est pas au bon format!!";
            }
        }
    }
} catch (\Throwable $th) {
    // dd($th);
}










// ! views

include __DIR__ . '/../views/templates/dashboard/header.php';
include __DIR__ . '/../views/frontVehicles/frontRents.php';
include __DIR__ . '/../views/templates/dashboard/footer.php';
