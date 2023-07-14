@extends('side')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Details vente</h5>
                        </div>
                        <div class="col-md-7">

                        </div>
                        <div class="col-md-2">
                            <br/>
                            <div class="col-md-12">
                                <button style="width: 150px;" type="button"
                                        class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addService">Nouveau</button>
                                <a href="/vente/liste"><button style="width: 150px;" type="button"
                                        class="btn btn-success">Valider</button></a>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="addService" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Ajout details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/vente/adddetail" method="get" class="row g-3">
                                            <div>
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

                    <?php echo $erreur; ?>
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Laptop</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">Prix unitaire</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($detail as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['reference']; ?></a></th>
                        <td><?php echo $row['quantite']; ?></td>
                        <td><a href="#" class="text-primary"><?php echo $row['prixunitaire']; ?></a></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <?php echo $detail->links(); ?>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
