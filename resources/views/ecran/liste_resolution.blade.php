@extends('adside')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Liste des types de resolutions d'un ecran</h5>
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
                                            <h5 class="modal-title">Nouveau</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/ecran/add_resolution" method="get" class="row g-3">
                                            <div>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="resolution"
                                                        placeholder="Resolution"></center>
                                                <br>

                                            </div>
                                            <center><input style="width: 100px;" type="submit" class="btn btn-primary" value="Ajouter"></center>
                                        </form>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal modifier --}}
                            <?php foreach($resolution as $row){ ?>
                            <div class="modal fade" id="modifier<?php echo $row['id']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modification</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/ecran/update_resolution" method="get" class="row g-3">
                                            <div>
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="resolution"
                                                        placeholder="Numero" value="<?php echo $row['resolution']; ?>"></center>

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
                            <?php foreach($resolution as $row){ ?>
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
                                        <a href="/ecran/supprimer_resolution?id=<?php echo $row['id']; ?>"><button style="width: 150px;" type="button" class="btn btn-primary">Supprimer</button></a></center>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <a href="/ecran/listeresolution"><button style="width: 150px;" type="button" class="btn btn-success">Resolution</button></a>
                        </div>
                        <div class="col-md-2">
                            <a href="/ecran/listeaffichage"><button style="width: 150px;" type="button" class="btn btn-success">Affichage</button></a>
                        </div>
                    </div>
                    <br/>

                  <table class="table table-borderless">
                    <thead>

                    {{-- Recherche multicritere --}}
                     <form action="/ecran/listeresolution">
                     <tr>
                        <th scope="col">
                            <input type="text" name="resolution" class="form-control" placeholder="Resolution">
                        </th>
                        <th>
                            <input type="submit" value="Rechercher" class="btn btn-primary">
                        </th>
                        <th></th>
                      </tr>
                      </form>
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Resolution</th>
                        <th></th>

                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($resolution as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['id']; ?></a></th>
                        <td><?php echo $row['resolution']; ?></td>
                        <td>
                            <button style="width: 150px;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modifier<?php echo $row['id']; ?>">Modifier</button>
                        </td>
                        <td>
                            <button style="width: 150px;" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#supprimer<?php echo $row['id']; ?>">Supprimer</button>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <?php echo $resolution->links(); ?>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
