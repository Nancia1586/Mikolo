<?php
    use App\Models\Util;
?>
@extends('side')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Reception laptop</h5>
                        </div>
                        <div class="col-md-7">

                        </div>
                        <div class="col-md-2">
                            <br/>
                            <div class="col-md-12">
                                <a href="/pointvente/liste_reception"><button style="width: 150px;" type="button"
                                        class="btn btn-success">Liste des laptops reçus</button></a>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="addService" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Nouveau transfert</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/magasin/add_transfert" method="get" class="row g-3">
                                            <div>
                                                <center><input style="width: 400px;" type="date" class="form-control" id="inputPassword4" name="date"
                                                        placeholder="Date"></center>
                                                <br>
                                                <center>
                                                    <select style="width: 400px;" name="laptop" class="form-control">
                                                        <option value="">Selectionnez un laptop</option>
                                                        <?php foreach($laptop as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['reference']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </center>
                                                <br>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="quantite"
                                                        placeholder="Quantite"></center>
                                                <br>

                                                <br>
                                                <center>
                                                    <select style="width: 400px;" name="pointvente" class="form-control">
                                                        <option value="">Selectionnez un point de vente</option>
                                                        <?php foreach($pointvente as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['emplacement']; ?></option>
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
                        </div>
                    </div>

                    <h5>Point de vente: <?php echo $emplacement['emplacement']; ?></h5>
                    <br/>
                  <table class="table table-borderless">
                    <thead>

                    {{-- Recherche multicritere --}}
                     <form action="/pointvente/reception">
                     <tr>
                        <th scope="col">
                            <input type="text" name="date" class="form-control" placeholder="Date">
                        </th>
                        <th scope="col">
                            <input type="text" name="reference" class="form-control" placeholder="Reference">
                        </th>
                        <th scope="col">
                            <input type="text" name="quantite" class="form-control" placeholder="Quantite">
                        </th>
                        <th scope="col">
                            <input type="text" name="prixunitaire" class="form-control" placeholder="Prix unitaire">
                        </th>
                        <th>
                            <input type="submit" value="Rechercher" class="btn btn-primary">
                        </th>

                      </tr>
                      </form>
                      <tr>
                        <th scope="col">Date d'envoie</th>
                        <th scope="col">Laptop</th>
                        <th scope="col">Quantite envoyé</th>
                        <th scope="col">PrixUnitaire</th>
                        <th scope="col">Date de reception</th>
                        <th scope="col">Quantite reçu</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($reception as $row){ ?>
                    <form action="/pointvente/add_reception" method="get">
                    <tr>
                        <input type="hidden" name="idpointvente" value="<?php echo $row['idpointvente']; ?>">
                        <input type="hidden" name="idsortiemagasin" value="<?php echo $row['id']; ?>">
                        <th scope="row">
                            <a href="#"><?php echo $row['date']; ?></a>
                        </th>
                        <td>
                            <input type="hidden" name="idlaptop" value="<?php echo $row['idlaptop']; ?>">
                            <?php echo $row['reference']; ?>
                        </td>
                        <td>
                            <input type="hidden" name="envoye" value="<?php echo $row['quantite']; ?>">
                            <a href="#" class="text-primary"><?php echo $row['quantite']; ?></a>
                        </td>
                        <td>
                            <input type="hidden" name="prixunitaire" value="<?php echo $row['prixunitaire']; ?>">
                            <?php echo Util::format($row['prixunitaire']); ?>
                        </td>
                        <td>
                            <input type="date" name="date" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="quantite" class="form-control">
                        </td>
                        <td>
                            <input type="submit" value="Valider" class="btn btn-success">
                        </td>
                    </tr>
                    </form>
                    <?php } ?>
                    </tbody>
                  </table>
                  <?php echo $reception->links(); ?>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
