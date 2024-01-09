<section>
    <div class="container" id="container__form">
        <div class="row">
            <div class="col">
                <!-- carte contenant le form -->
                <div class="card bg-light mb-3" style="max-width: 20rem;">
                    <div class="card-body p-5">
                        <!-- form -->
                        <form method="POST" novalidate>
                            <div class="form-group">
                                <div class="text-info fw-bold">
                                    <?= $msg ?? '' ?>
                                </div>
                                <label class="col-form-label mt-4" for="name">Modifier le nom d'une catégorie</label>
                                <input type="text" class="form-control" 
                                placeholder="Exemple : Voitures de Formule 1" 
                                id="name" 
                                name="name" 
                                minlength="2" 
                                maxlength="30" 
                                required
                                value="<?=
                                    $_GET['name']
                                ?>" >
                                <small class="text-danger"><?= $error['name'] ?? '' ?></small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-5">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>