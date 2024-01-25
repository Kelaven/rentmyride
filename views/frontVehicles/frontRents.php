<section class="container">
    <div class="row justify-content-center ">
        <div class="col-lg-6 pt-2">
            <div class="card bg-light mb-3 w-100">
                <div class="card-header">
                    Réservez votre véhicule
                </div>
                <div class="card-body p-5">
                    <!-- form -->
                    <form method="POST" class="d-flex justify-content-center" novalidate>
                        <div class="form-group">
                            <div class="text-info fw-bold">
                                <?= $msg ?? '' ?>
                            </div>
                            <div class="col d-flex justify-content-between">
                                <div class="col-6 form-group">
                                    <label for="startdate">Date de début :</label>
                                    <input class="form-control" type="date" name="startdate" id="startdate" value="<?= htmlentities($startdate ?? '') ?>" min="<?= date("Y-m-d") ?>" max="2030-12-31">
                                    <small class="text-danger"><?= $error['startdate'] ?? '' ?></small>
                                </div>
                                <div class="col-6 form-group ps-4">
                                    <label for="enddate">Date de fin :</label><br>
                                    <input class="form-control" type="date" id="enddate" name="enddate" value="<?= htmlentities($enddate ?? '') ?>" min="<?= date("Y-m-d") ?>" max="2030-12-31" />
                                    <small class="text-danger"><?= $error['enddate'] ?? '' ?></small>
                                </div>
                            </div>
                            <div class="col d-flex">
                                <div class="form-group">
                                    <label for="lastname" class="form-label mt-4">Nom :</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Doe" autocomplete="on" value="<?= htmlentities($lastname ?? '') ?>" minlength="2" maxlength="70" pattern="<?= REGEX_NO_NUMBER ?>">
                                    <small class="text-danger"><?= $error['lastname'] ?? '' ?></small>
                                </div>
                                <div class="form-group ps-5">
                                    <label for="firstname" class="form-label mt-4">Prénom :</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="John" autocomplete="on" value="<?= htmlentities($firstname ?? '') ?>" minlength="2" maxlength="70" pattern="<?= REGEX_NO_NUMBER ?>">
                                    <small class="text-danger"><?= $error['firstname'] ?? '' ?></small>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="email" class="form-label mt-4">E-mail :</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="john.doe@gmail.com" autocomplete="on" value="<?= htmlentities($email ?? '') ?>">
                                    <small class="text-danger"><?= $error['email'] ?? '' ?></small>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-between">
                                <div class="form-group">
                                    <label for="birthday" class="form-label mt-4">Date de naissance :</label>
                                    <input type="date" name="birthday" id="birthday" value="<?= htmlentities($birthday ?? '') ?>" class="form-control <?= isset($error['birthday']) ? 'errorField' : '' ?>" autocomplete="bday" aria-describedby="birthdayHelp" min="<?= (date('Y') - 120) . date('-m-d') ?>" max="<?= date('Y-m-d') ?>">
                                    <small class="text-danger"><?= $error['birthday'] ?? '' ?></small>
                                </div>
                                <div class="form-group ms-3 ms-lg-0">
                                    <label for="phone" class="form-label mt-4">Téléphone :</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="<?= htmlentities($phone ?? '') ?>" placeholder="0612345678" autocomplete="on">
                                    <small class="text-danger"><?= $error['phone'] ?? '' ?></small>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-between">
                                <div class="form-group">
                                    <label for="city" class="form-label mt-4">Ville :</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Amiens" autocomplete="on" value="<?= htmlentities($city ?? '') ?>" minlength="2" maxlength="70" pattern="<?= REGEX_NO_NUMBER ?>">
                                    <small class="text-danger"><?= $error['city'] ?? '' ?></small>
                                </div>
                                <div class="form-group ms-3 ms-lg-0">
                                    <label for="zipcode" class="form-label mt-4">Code postal :</label>
                                    <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="80000" autocomplete="on" value="<?= htmlentities($zipcode ?? '') ?>" minlength="5" maxlength="5" pattern="<?= REGEX_ZIPCODE ?>">
                                    <small class="text-danger"><?= $error['zipcode'] ?? '' ?></small>
                                </div>
                            </div>
                            <div class="col text-center pt-5">
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>