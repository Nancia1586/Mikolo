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
                            <h5 class="card-title">Renvoi laptop</h5>
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
                                            <h5 class="modal-title">Nouveau transfert</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/pointvente/add_renvoi" method="get" class="row g-3">
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

                    <h5 style="color:red;"><?php echo $erreur; ?></h5>
                    <br/>
                  <table class="table table-borderless">
                    <thead>

                    {{-- Recherche multicritere --}}
                     <form action="/magasin/transfert">
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
                        <th scope="col">Date</th>
                        <th scope="col">Laptop</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">PrixUnitaire</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($renvoi as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['date']; ?></a></th>
                        <td><?php echo $row['reference']; ?></td>
                        <td><a href="#" class="text-primary"><?php echo $row['quantite']; ?></a></td>
                        <td><?php echo Util::format($row['prixunitaire']); ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <?php echo $renvoi->links(); ?>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
