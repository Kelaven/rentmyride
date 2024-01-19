<section class="pe-5">
    <div class="container p-5" id="container__creatList">
        <div class="row pt-5">
            <div class="col pt-5">
                <!-- bouton de redirection pour ajouter une catégorie -->
                <a href="/controllers/dashboard/vehicles/addVehicles-ctrl.php">
                    <button type="button" class="btn btn-dark"><i class="fa-solid fa-plus pe-3"></i>Ajouter un véhicule</button>
                </a>
            </div>
        </div>
    </div>
    <div class="container p-5 pt-0" id="container__readList">
        <div class="row">
            <div class="col">
                <!-- carte contenant les infos -->
                <div class="card bg-light mb-3">
                    <div class="card-header">
                        Liste des véhicules
                    </div>
                    <div class="card-body p-5 pt-3">
                        <p class="text-info">
                            <?= $msg ?? '' ?>
                        </p>
                        <table class="">
                            <tr>
                                <th>Catégorie :<a href="/controllers/dashboard/vehicles/listVehicles-ctrl.php?click=1" data-bs-toggle="tooltip" data-bs-title="Ordre alphabétique"><i class="fa-solid fa-caret-up px-2"></i></a><a href="/controllers/dashboard/vehicles/listVehicles-ctrl.php?click=2" data-bs-toggle="tooltip" data-bs-title="Désordre alphabétique"><i class="fa-solid fa-caret-down"></i></a></th>
                                <th>Marque :</th>
                                <th>Modèle :</th>
                                <th>Image :</th>
                                <th></th> <!-- modifier -->
                                <th></th> <!-- supprimer -->
                            </tr>
                            <?php
                            foreach ($vehicles as $vehicle) { ?>
                                <tr>
                                    <td> <?= $vehicle->name; ?> </td>
                                    <td> <?= $vehicle->brand; ?> </td>
                                    <td> <?= $vehicle->model; ?> </td>
                                    <td> <?php if (!empty($vehicle->picture)) { ?>
                                            <img class="listVehicles__pic" src="/public/uploads/users/<?= $vehicle->picture ?>">
                                        <?php }  ?>
                                    </td>
                                    <td>
                                        <a href="/controllers/dashboard/vehicles/updateVehicles-ctrl.php?id_vehicle=<?= $vehicle->id_vehicle ?>" data-bs-toggle="tooltip" data-bs-title="Modifier"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                    <td class="text-end">
                                        <a class="delete__link" data-delete="<?= $vehicle->id_vehicle ?>" data-bs-toggle="tooltip" data-bs-title="Supprimer"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </table>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>