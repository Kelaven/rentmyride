<section>
    <div class="container" id="container__form">
        <div class="row">
            <div class="col">
                <!-- carte contenant le form -->
                <div class="card bg-light mb-3">
                    <div class="card-body p-5">
                        <!-- form -->
                        <form method="POST" enctype="multipart/form-data" novalidate>
                            <div class="form-group">
                                <div class="text-info fw-bold">
                                    <?= $msg ?? '' ?>
                                    <?= $error['isExist'] ?? '' ?>
                                </div>
                                <div class="container__inputs">
                                    <div class="container__inputs--left">
                                        <!-- categories -->
                                        <div class="form-group">
                                            <label for="id_category" class="form-label pt-3">Modifier la catégorie :</label>
                                            <select class="form-select" id="id_category" name="id_category">
                                                <?php
                                                foreach ($categories as $category) { ?>
                                                    <option value="<?= $category->id_category ?>"<?php if ((isset($id_category)) && ($id_category == $category->id_category)) { ?>
                                                        selected
                                                    <?php } ?>><?= ucfirst($category->name) ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- brand -->
                                        <label class="col-form-label" for="brand">Modifier la marque :</label>
                                        <input type="text" class="form-control" placeholder="Audi" id="brand" name="brand" minlength="2" maxlength="30" required value="<?= $brand ?? '' ?>">
                                        <div>
                                            <small class="text-danger"><?= $error['brand'] ?? '' ?></small>
                                        </div>
                                        <!-- model -->
                                        <label class="col-form-label" for="model">Modifier le modèle :</label>
                                        <input type="text" class="form-control" placeholder="a3" id="model" name="model" minlength="1" maxlength="30" required value="<?= $model ?? '' ?>">
                                        <div>
                                            <small class="text-danger"><?= $error['model'] ?? '' ?></small>
                                        </div>
                                    </div>
                                    <div class="container__inputs--right">
                                        <div class="container__inputs--right--center">
                                            <!-- registration -->
                                            <label class="col-form-label" for="registration">Modifier la plaque d'immatriculation :</label>
                                            <input type="text" class="form-control" placeholder="AB-123-CD" id="registration" name="registration" required value="<?= $registration ?? '' ?>">
                                            <div>
                                                <small class="text-danger"><?= $error['registration'] ?? '' ?></small>
                                            </div>
                                            <!-- mileage -->
                                            <label class="col-form-label" for="mileage">Modifier le Kilométrage :</label>
                                            <input type="number" class="form-control" placeholder="12500" id="mileage" name="mileage" required value="<?= $mileage ?? '' ?>">
                                            <div>
                                                <small class="text-danger"><?= $error['mileage'] ?? '' ?></small>
                                            </div>
                                            <!-- picture (nullable) -->
                                            <label class="col-form-label label__pic" for="picture">Modifier la photo :</label>
                                            <input type="file" class="form-control label__input" placeholder="Photo de la voiture" id="picture" name="picture" accept="image/png, image/jpeg">
                                            <div>
                                                <small class="text-danger"><?= $error['picture'] ?? '' ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container__btn">
                                <button type="submit" class="btn btn-primary mt-5">Valider</button>
                            </div>
                            <!-- <div>
                                <p class="text-end m-0 msg__nb">* données obligatoires</p>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>