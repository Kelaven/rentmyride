<?php

// ! fichier init

require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';





try {
    // modification du header
    $css = 'listCategories.css';
    $title = 'Consultation des catégories';

    // pour afficher les catégories
    $list = new Category();
    $results = $list->getAll();
    

} catch (\Throwable $th) {
    echo "Erreur : " . $th->getMessage();
}






// ! views

include __DIR__ . '/../../../views/templates/dashboard/header.php';
include __DIR__ . '/../../../views/dashboard/categories/list.php';
include __DIR__ . '/../../../views/templates/dashboard/footer.php';