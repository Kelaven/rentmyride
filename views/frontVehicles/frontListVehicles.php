<section>
    <div class="container container__home">
        <div class="row w-100">
            <div class="col d-flex justify-content-end">
                <a href="/controllers/dashboard/vehicles/listVehicles-ctrl.php" class="btn btn-primary btn-sm">Accès dashboard</button></a>

            </div>
        </div>
        <div class="row w-100">
            <div class="col text-center py-5">
                <h1>Tous les véhicules disponibles à la location</h1>
            </div>
        </div>
        <div class="row w-100 pt-5">
            <div class="col">
                <p>Trier par catégories <a href="/controllers/front/home-ctrl.php?click=1" data-bs-toggle="tooltip" data-bs-title="Ordre alphabétique"><i class="fa-solid fa-caret-up px-2"></i></a><a href="/controllers/front/home-ctrl.php?click=2" data-bs-toggle="tooltip" data-bs-title="Désordre alphabétique"><i class="fa-solid fa-caret-down"></i></a></p>
            </div>
        </div>
        <div class="row w-100 justify-content-center">
            <?php
            foreach ($vehicles as $vehicle) { ?>
                <div class="col-12 col-md-6 col-xl-3 d-flex justify-content-center text-center py-4">
                    <div class="card bg-light">
                        <div class="card-header p-0"><img class="card__img" src="/public/uploads/users/<?= $vehicle->picture ?>" alt="Image d'une voiture disponible à la location"></div>
                        <div class="card-body">
                            <h4 class="card-title pt-3"><?= $vehicle->name ?></h4>
                            <h5 class="card-text py-3"><?= $vehicle->brand . ' ' . $vehicle->model ?></h5>
                            <a href="#" class="btn btn-outline-primary">Réserver</a>
                        </div>
                    </div>
                </div>
            <?php }
            ?>

        </div>
    </div>
</section>