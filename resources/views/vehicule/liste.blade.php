@extends('adside')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Liste vehicule</h5>
                        </div>
                        <div class="col-md-7">

                        </div>
                        <div class="col-md-2">
                            <br/>
                            <div class="col-md-12">
                                <button style="width: 150px;" type="button"
                                        class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addService">Nouveau</button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="addService" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Nouveau vehicule</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/vehicule/add" method="get" class="row g-3">
                                            <div>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="numero"
                                                        placeholder="Numero"></center>
                                                <br>
                                                <center>
                                                    <select style="width: 400px;" name="marque" class="form-control">
                                                        <option value="">Selectionnez une marque</option>
                                                        <?php foreach($marque as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['marque']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </center>
                                                <br>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="modele"
                                                        placeholder="Modele"></center>
                                                <br>
                                                <center>
                                                    <select style="width: 400px;" name="type" class="form-control">
                                                        <option value="">Selectionnez un type</option>
                                                        <?php foreach($type as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['type']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </center>
                                            </div>
                                            <center><input style="width: 100px;" type="submit" class="btn btn-primary" value="Ajouter"></center>
                                        </form>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal modifier --}}
                            <?php foreach($vehicule as $row){ ?>
                            <div class="modal fade" id="modifier<?php echo $row['id']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modification</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/vehicule/update" method="get" class="row g-3">
                                            <div>
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="numero"
                                                        placeholder="Numero" value="<?php echo $row['numero']; ?>"></center>
                                                <br>
                                                <center>
                                                    <select style="width: 400px;" name="marque" class="form-control">
                                                        <option value="<?php echo $row['idmarque']; ?>"><?php echo $row['marque']; ?></option>
                                                        <?php foreach($marque as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['marque']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </center>
                                                <br>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="modele"
                                                        placeholder="Modele" value="<?php echo $row['modele']; ?>"></center>
                                                <br>
                                                <center>
                                                    <select style="width: 400px;" name="type" class="form-control">
                                                        <option value="<?php echo $row['idtype']; ?>"><?php echo $row['type']; ?></option>
                                                        <?php foreach($type as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['type']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </center>
                                            </div>
                                            <center><input style="width: 100px;" type="submit" class="btn btn-primary" value="Modifier"></center>
                                        </form>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            {{-- Modal supprimer --}}
                            {{-- Modal modifier --}}
                            <?php foreach($vehicule as $row){ ?>
                            <div class="modal fade" id="supprimer<?php echo $row['id']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                         <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <center><p>Etes-vous sur de vouloir continuer la suppression?</p></center>
                                        <center><button style="width: 150px;" type="button" data-bs-dismiss="modal" class="btn btn-danger">Annuler</button>
                                        <a href="/vehicule/supprimer?id=<?php echo $row['id']; ?>"><button style="width: 150px;" type="button" class="btn btn-primary">Supprimer</button></a></center>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                  <table class="table table-borderless">
                    <thead>
                        {{-- Recherche simple --}}
                    <form action="/vehicule/liste">
                     <tr>
                        <th scope="col">
                            <input type="text" name="mot" class="form-control" placeholder="Saisissez">
                        </th>
                        <th>
                            <input type="submit" value="Rechercher" class="btn btn-primary">
                        </th>
                        <th></th>
                        <th></th>
                      </tr>
                    </form>

                    {{-- Recherche multicritere --}}
                     <form action="/vehicule/liste">
                     <tr>
                        <th scope="col">
                            <input type="text" name="numero" class="form-control" placeholder="Numero">
                        </th>
                        <th scope="col">
                            <input type="text" name="marque" class="form-control" placeholder="Marque">
                        </th>
                        <th scope="col">
                            <input type="text" name="modele" class="form-control" placeholder="Modele">
                        </th>
                        <th scope="col">
                            <input type="text" name="type" class="form-control" placeholder="Type">
                        </th>
                        <th>
                            <input type="submit" value="Rechercher" class="btn btn-primary">
                        </th>
                        <th></th>
                        <th></th>
                      </tr>
                      </form>
                      <tr>
                        <th scope="col">Numero</th>
                        <th scope="col">Marque</th>
                        <th scope="col">Modele</th>
                        <th scope="col">Type</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($vehicule as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['numero']; ?></a></th>
                        <td><?php echo $row['marque']; ?></td>
                        <td><a href="#" class="text-primary"><?php echo $row['modele']; ?></a></td>
                        <td><?php echo $row['type']; ?></td>
                        <td>
                            <button style="width: 150px;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modifier<?php echo $row['id']; ?>">Modifier</button>
                        </td>
                        <td>
                            <button style="width: 150px;" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#supprimer<?php echo $row['id']; ?>">Supprimer</button>
                        </td>
                        <td>
                            <a href="/vehicule/showpdf?idvehicule=<?php echo $row['id']; ?>"><button class="btn btn-primary">Liste des trajets en pdf</button></a>
                        </td>
                        <td>
                            <a href="/vehicule/exportcsv?idvehicule=<?php echo $row['id']; ?>"><button class="btn btn-primary">Liste des trajets en csv</button></a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <?php echo $vehicule->links(); ?>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
