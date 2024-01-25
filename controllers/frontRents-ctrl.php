<?php



try {
    $title = 'Réservation de véhicule';





} catch (\Throwable $th) {
    dd($th);
}










// ! views

include __DIR__ . '/../views/templates/dashboard/header.php';
include __DIR__ . '/../views/frontVehicles/frontRents.php';
include __DIR__ . '/../views/templates/dashboard/footer.php';