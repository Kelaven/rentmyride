<?php

// ! fichier init

require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';


try {
    $id_category = intval(filter_input(INPUT_GET, 'id_category', FILTER_SANITIZE_NUMBER_INT)); // récupérer la donnée tout en la nettoyant, ne pas utiliser $_GET. intval permet de retourner un entier dans tous les cas, 1 au lieu de "1"

    $delete = Category::delete($id_category);

    header('Location: /controllers/dashboard/categories/list-ctrl.php'); // si la suppression fonctionne, on renvoie sur la même page en la rafraîchissant


} catch (\Throwable $th) {
    echo "Erreur : " . $th->getMessage();
}
