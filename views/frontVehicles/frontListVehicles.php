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
            </div>
        </div>
        <div class="row w-100 justify-content-center">
            <form method="POST">
                <div class="form-group form-group--frontListVehicles">
                    <label for="id_category" class="form-label">Filtrer par catégories :</label>
                    <div class="d-flex">
                        <select class="form-select form-select--frontListVehicles" id="id_category" name="id_category">
                            <?= $error['id_category'] ?? '' ?>
                            <option value="">Toutes les catégories</option>
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
            </form>
            <?php
            foreach ($displayVehicles as $displayVehicle) { ?>
                <div class="col-12 col-md-6 col-xl-3 d-flex justify-content-center text-center py-4">
                    <div class="card bg-light">
                        <div class="card-header p-0"><img class="card__img" src="/public/uploads/users/<?= $displayVehicle->picture ?>" alt="Image d'une voiture disponible à la location"></div>
                        <div class="card-body">
                            <h4 class="card-title pt-3"><?= $displayVehicle->name ?? '' ?></h4>
                            <h5 class="card-text py-3"><?= $displayVehicle->brand . ' ' . $displayVehicle->model ?></h5>
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
                        <li class="page-item <?php if ($currentPage == 1) { ?>
                            disabled
                        <?php } ?>">
                            <a class="page-link" href="/controllers/frontListVehicles-ctrl.php?page=<?= $currentPage - 1 ?>">&laquo;</a>
                        </li>
                        <?php
                        for ($page = 1; $page <= $nbePages; $page++) { ?>
                            <li class="page-item <?php if ($page == $currentPage) { ?> active <?php } ?>">
                                <a class="page-link" href="/controllers/frontListVehicles-ctrl.php?page=<?= $page ?>"><?= $page ?></a>
                            </li>
                        <?php
                        }
                        ?>
                        <!-- <li class="page-item active">
                            <a class="page-link" href="/controllers/frontListVehicles-ctrl.php?page=1">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="/controllers/frontListVehicles-ctrl.php?page=2">2</a>
                        </li> -->
                        <li class="page-item <?php if ($currentPage == $nbePages) { ?>
                            disabled
                        <?php } ?>">
                            <a class="page-link" href="/controllers/frontListVehicles-ctrl.php?page=<?= $currentPage + 1 ?>">&raquo;</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>