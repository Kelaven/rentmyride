<?php


// ! fichier init

require_once __DIR__ . '/../../../config/init.php';





// ! Si le formulaire est envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // * nettoyage et validation du form
    $error = [];
    // pour ajouter une catégorie :
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS); // filtre de nettoyage
    $is_name_ok = filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_CATEGORY . '/'))); // filtre de validation
    if (!$is_name_ok) {
        $error['name'] = 'Le nom de la catégorie doit contenir 2 à 30 caractères alphabétiques.';
    }
    if ($error == []) {
        $result = 'La donnée a bien été envoyée !';
    }





    // * connexion à la BDD pour y insérer la valeur entrée
    // https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/requete-preparee/ 

    $dsn = 'mysql:dbname=rentmyride;host=localhost';
    $user = 'rentmyride_admin';
    $password = '2t9#csRh$%uQ^wWPaFTb';

    try {
        $objetPdo = new PDO($dsn, $user, $password);

        $name = $_POST['name'];

        $sth = $objetPdo->prepare("
        INSERT INTO
        categories(name)
        VALUES (:name)
        ");

        $sth->execute(array(
            ':name' => $name
        ));

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}





// ! views

include __DIR__ . '/../../../views/templates/dashboard/header.php';
include __DIR__ . '/../../../views/dashboard/categories/add.php';
include __DIR__ . '/../../../views/templates/dashboard/footer.php';
