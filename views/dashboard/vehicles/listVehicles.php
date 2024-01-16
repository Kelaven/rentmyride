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
                            <!-- <?= $msg ?> -->
                        </p>
                        <table class="">
                            <tr>
                                <th>Catégorie :</th>
                                <th>Marque :</th>
                                <th>Modèle :</th>
                                <th></th> <!-- modifier -->
                                <th></th> <!-- supprimer -->
                            </tr>
                            <?php
                            foreach ($vehicles as $vehicle) { ?>
                                <tr>
                                    <td> <?= $vehicle->name; ?> </td>
                                    <td> <?= $vehicle->brand; ?> </td>
                                    <td> <?= $vehicle->model; ?> </td>
                                    <td>
                                        <a href="#" data-bs-toggle="tooltip" data-bs-title="Modifier"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="delete__link" data-bs-toggle="tooltip" data-bs-title="Supprimer"><i class="fa-solid fa-trash"></i></a>
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