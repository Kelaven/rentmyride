<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent my Ride</title>
    <!-- bootswatch -->
    <link href="/public/assets/framework/bootstrap.min.css" rel="stylesheet">
    <!-- mon style -->
    <link rel="stylesheet" href="/public/assets/css/header.css">


</head>

<body>

    <!-- Sidebar -->
    <section>
        <div id="container__sidebar">
            <ul class="sidebar__nav">
                <li class="sidebar__nav--title pt-3">
                    <a href="#">Dashboard</a>
                </li>
                <hr class="mb-0 mt-2 py-3">
                <li>
                    <a href="/controllers/dashboard/categories/add-ctrl.php" class="sidebar__nav--tabs"><i class="fa-solid fa-truck-plane pe-2"></i>Catégories</a>
                </li>
                <li>
                    <a href="#" class="sidebar__nav--tabs"><i class="fa-solid fa-cogs pe-2"></i>Véhicules</a>
                </li>
                <li>
                    <a href="#" class="sidebar__nav--tabs"><i class="fa-solid fa-road pe-2"></i>Réservations</a>
                </li>
            </ul>
        </div>

    </section>