<section class="pe-5">
    <div class="container p-5" id="container__creatList">
        <div class="row pt-5">
            <div class="col pt-5">
                <a href="/controllers/dashboard/vehicles/listVehicles-ctrl.php"><p>Retour à la liste des véhicules</p></a>
            </div>
        </div>
    </div>
    <div class="container p-5 pt-0" id="container__readList">
        <div class="row">
            <div class="col">
                <!-- carte contenant les infos -->
                <div class="card bg-light mb-3">
                    <div class="card-header">
                        Véhicules archivés
                    </div>
                    <div class="card-body p-5 pt-3">
                        <p class="text-info">
                            <?= $msg ?? '' ?>
                        </p>
                        <table class="">
                            <tr>
                                <th>Catégorie :<a href="/controllers/dashboard/vehicles/archiveVehicles-ctrl.php?click=1" data-bs-toggle="tooltip" data-bs-title="Ordre alphabétique"><i class="fa-solid fa-caret-up px-2"></i></a><a href="/controllers/dashboard/vehicles/archiveVehicles-ctrl.php?click=2" data-bs-toggle="tooltip" data-bs-title="Désordre alphabétique"><i class="fa-solid fa-caret-down"></i></a></th>
                                <th>Marque :</th>
                                <th>Modèle :</th>
                                <th>Image :</th>
                                <th></th> <!-- modifier -->
                                <th></th> <!-- supprimer -->
                            </tr>
                            <?php
                            foreach ($getArchiveds as $getArchived) { ?>
                                <tr>
                                    <td> <?= $getArchived->name; ?> </td>
                                    <td> <?= $getArchived->brand; ?> </td>
                                    <td> <?= $getArchived->model; ?> </td>
                                    <td> <?php if (!empty($getArchived->picture)) { ?>
                                            <img class="listVehicles__pic" src="/public/uploads/users/<?= $getArchived->picture ?>">
                                        <?php }  ?>
                                    </td>
                                    <td>
                                        <a href="/controllers/dashboard/vehicles/unarchiveVehicles-ctrl.php?id_vehicle=<?= $getArchived->id_vehicle ?>" data-bs-toggle="tooltip" data-bs-title="Désarchiver"><i class="fa-solid fa-box-open"></i></a>
                                    </td>
                                    <td class="text-end">
                                        <a class="delete__link" data-delete="<?= $getArchived->id_vehicle ?>" data-bs-toggle="tooltip" data-bs-title="Supprimer"><i class="fa-solid fa-trash"></i></a>
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