<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Rent my Ride - <?= $title ?? '' ?>
    </title>
    <!-- bootswatch -->
    <link href="/public/assets/framework/bootstrap.min.css" rel="stylesheet">
    <!-- mon style -->
    <link rel="stylesheet" href="/public/assets/css/header.css">
    <?php
    if (isset($cssCategories)) {
    ?>
        <link rel="stylesheet" href="/public/assets/css/categories/<?= $cssCategories ?>">
    <?php } ?>
    <?php
    if (isset($cssVehicles)) {
    ?>
        <link rel="stylesheet" href="/public/assets/css/vehicles/<?= $cssVehicles ?>">
    <?php } ?>
    <?php
    if (isset($cssAddVehicles)) {
    ?>
        <link rel="stylesheet" href="/public/assets/css/vehicles/<?= $cssAddVehicles ?>">
    <?php } ?>
    <?php
    if (isset($cssReadVehicles)) {
    ?>
        <link rel="stylesheet" href="/public/assets/css/vehicles/<?= $cssReadVehicles ?>">
    <?php } ?>
    <?php
    if (isset($cssUpdateVehicles)) {
    ?>
        <link rel="stylesheet" href="/public/assets/css/vehicles/<?= $cssUpdateVehicles ?>">
    <?php } ?>


</head>

<body>

    <!-- Sidebar -->
    <?php if (isset($sidebar)) { ?>
        <section>
        <div id="container__sidebar">
            <ul class="sidebar__nav">
                <li class="sidebar__nav--title pt-3">
                    <a href="/controllers/dashboard/vehicles/listVehicles-ctrl.php">Dashboard</a>
                </li>
                <hr class="mb-0 mt-2 py-3">
                <li>
                    <a href="/controllers/dashboard/categories/list-ctrl.php" class="sidebar__nav--tabs"><i class="fa-solid fa-truck-plane pe-2"></i>Catégories</a>
                </li>
                <li>
                    <a href="/controllers/dashboard/vehicles/listVehicles-ctrl.php" class="sidebar__nav--tabs"><i class="fa-solid fa-cogs pe-2"></i>Véhicules</a>
                </li>
                <li>
                    <a href="#" class="sidebar__nav--tabs"><i class="fa-solid fa-road pe-2"></i>Réservations</a>
                </li>
            </ul>
            <a class="btn btn-primary btn__home" href="/controllers/frontListVehicles-ctrl.php">page d'accueil</a>
        </div>
    </section>
    <?php } ?>
    