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
        <form class="w-100 pt-5">
            <div class="row w-100 justify-content-start">
                <div class="col-xl-4">
                    <label for="id_category" class="form-label">Filtrer par catégories :</label>
                    <div class="d-flex">
                        <select class="form-select form-select--frontListVehicles" id="id_category" name="id_category">
                            <?= $error['id_category'] ?? '' ?>
                            <option value="0" selected>Toutes les catégories</option>
                            <?php
                            foreach ($categories as $category) {
                            ?>
                                <option value="<?= $category->id_category ?>" <?php if ($category->id_category == $id_category && !empty($id_category)) { ?> selected <?php } ?>> <?= ucfirst($category->name) ?> </option>
                            <?php }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-dark">Filtrer</button>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <label for="search" class="form-label">Rechercher par mots clés :</label>
                    <div class="d-flex">
                        <div class="d-flex">
                            <input id="search" name="search" class="form-control w-75" type="search" placeholder="Recherche de modèle">
                            <button class="btn btn-dark my-2 my-sm-0" type="submit">Rechercher</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row w-100">
            <?php
            foreach ($vehicles as $vehicle) { ?>
                <div class="col-12 col-md-6 col-xl-3 d-flex justify-content-center text-center py-4">
                    <div class="card bg-light">
                        <div class="card-header p-0">
                            <?php if ($vehicle->picture) { ?>
                                <img class="card__img" src="/public/uploads/users/<?= $vehicle->picture ?>" alt="<?= $vehicle->brand ?> <? $vehicle->model ?>">
                            <?php } else { ?>
                                <img class="card__img" src="/public/assets/img/anonym-car-illustration.jpeg" alt="Illustration d'une voiture">
                            <?php } ?>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title pt-3"><?= $vehicle->name ?? '' ?></h4>
                            <h5 class="card-text py-3"><?= $vehicle->brand . ' ' . $vehicle->model ?></h5>
                            <a href="#" class="btn btn-outline-primary">Réserver</a>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>

        <div class="row">
            <div class="col py-4">
                <div>
                    <ul class="pagination">
                        <li class="page-item <?php if ($page == 1) { ?>
                            disabled
                        <?php } ?>">
                            <a class="page-link" href="/controllers/frontListVehicles-ctrl.php?page=<?= $page - 1 ?>&id_category=<?= $id_category ?>">&laquo;</a>
                        </li>
                        <?php
                        for ($p = 1; $p <= $nbePages; $p++) { ?>
                            <li class="page-item <?php if ($p == $page) { ?> active <?php } ?>">
                                <a class="page-link" href="/controllers/frontListVehicles-ctrl.php?page=<?= $p ?>&id_category=<?= $id_category ?>"><?= $p ?></a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="page-item <?php if ($page == $nbePages) { ?>
                            disabled
                        <?php } ?>">
                            <a class="page-link" href="/controllers/frontListVehicles-ctrl.php?page=<?= $page + 1 ?>&id_category=<?= $id_category ?>">&raquo;</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>