<?php

session_start(); // on va utiliser les sessions


// ! fichier init

require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';


try {
    $id_category = intval(filter_input(INPUT_GET, 'id_category', FILTER_SANITIZE_NUMBER_INT)); // récupérer la donnée tout en la nettoyant, ne pas utiliser $_GET. intval permet de retourner un entier dans tous les cas, 1 au lieu de "1" ou 0 au lieu de false

    $delete = Category::delete($id_category);
var_dump($delete);
die;

    if ($delete) {

        $msg = 'La donnée a bien été supprimée !';

        $_SESSION['msg'] = $msg; // $_SESSION est un tableau

        // header('Location: /controllers/dashboard/categories/list-ctrl.php?msg=' . $msg); // si la suppression fonctionne, on renvoie sur la même page en la rafraîchissant
        header('Location: /controllers/dashboard/categories/list-ctrl.php');
        die; // on mets un die ou exit après une redirection
    } else {
        $msg = 'La donnée n\'a pas été supprimée.';
        $_SESSION['msg'] = $msg;
    }
} catch (\Throwable $th) {
    $errorCode = intval($th->getCode());
    var_dump($errorCode);
    if ($errorCode === 23000) {
        $msg = 'Erreur ! La catégorie n\'a pas été supprimée car elle contient un ou plusieurs véhicules.';
        $_SESSION['msg'] = $msg;
        header('Location: /controllers/dashboard/categories/list-ctrl.php');
        die;
    } else {
        echo "Erreur : " . $th->getMessage();
    }
}


// ! views
include __DIR__ . '/../../../views/templates/dashboard/footer.php';
