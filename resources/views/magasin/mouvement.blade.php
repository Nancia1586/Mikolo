<?php
    use App\Models\Util;
?>
@extends('adside')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Mouvement de stock</h5>
                        </div>
                        <div class="col-md-7">

                        </div>
                        <div class="col-md-2">
                            <br/>
                            {{-- <div class="col-md-12">
                                <button style="width: 150px;" type="button"
                                        class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addService">Nouveau</button>
                            </div> --}}
                            <!-- Modal -->
                            <div class="modal fade" id="addService" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Nouvel arrivage</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/magasin/add_arrivage" method="get" class="row g-3">
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
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="prixunitaire"
                                                        placeholder="Prix unitaire"></center>
                                                <br>
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

                  <table class="table table-borderless">
                    <thead>

                    {{-- Recherche multicritere --}}
                     <form action="/magasin/mouvement">
                     <tr>
                        <th>
                            <select style="width: 400px;" name="laptop" class="form-control">
                                <option value="">Selectionnez un laptop</option>
                                <?php foreach($laptop as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['reference']; ?></option>
                                <?php } ?>
                            </select>
                        </th>
                        <th>
                            <input style="width: 100px;" type="submit" class="btn btn-primary" value="Voir">
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                      </form>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Laptop</th>
                        <th scope="col">Entree</th>
                        <th scope="col">Sortie</th>
                        <th scope="col">PrixUnitaire</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($mouvement as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['date']; ?></a></th>
                        <td><?php echo $row['reference']; ?></td>
                        <td><a href="#" class="text-primary"><?php echo $row['entree']; ?></a></td>
                        <td><a href="#" class="text-primary"><?php echo $row['sortie']; ?></a></td>
                        <td><?php echo Util::format($row['prixunitaire']); ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <?php echo $mouvement->links(); ?>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
