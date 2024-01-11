<section>
    <div class="container" id="container__form">
        <div class="row">
            <div class="col">
                <!-- carte contenant le form -->
                <div class="card bg-light mb-3" style="max-width: 20rem;">
                    <div class="card-header">
                        Ajouter un nouveau véhicule
                    </div>
                    <div class="card-body p-5">
                        <!-- form -->
                        <form method="POST">
                            <div class="form-group">
                                <div class="text-info fw-bold">
                                    <?= $msg ?? '' ?>
                                </div>
                                <label class="col-form-label mt-4" for="name">Ajouter un nouveau véhicule</label>
                                <input type="text" class="form-control" placeholder="Exemple : Range Rover" id="name" name="name" minlength="2" maxlength="30" required>
                                <small class="text-danger"><?= $error['name'] ?? '' ?></small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-5">Valider</button>
                        </form>
                    </div>
                </div>
                <a href="/controllers/dashboard/vehicles/listVehicles-ctrl.php">
                    <p>Retour à la liste des véhicules</p>
                </a>
            </div>
        </div>
    </div>
</section>