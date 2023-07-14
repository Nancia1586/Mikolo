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
                                        class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addService">Mettre à jour</button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="addService" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Mise à jour</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/echeance/add" method="get" class="row g-3">
                                            <div>
                                                <input type="hidden" name="idvehicule" value="<?php echo $idvehicule; ?>">
                                                <input type="hidden" name="idtypeecheance" value="<?php echo $idtypeecheance; ?>">
                                                <center><input style="width: 400px;" type="date" class="form-control" id="inputPassword4" name="debut"
                                                        placeholder="Debut"></center>
                                                <br>
                                                <center><input style="width: 400px;" type="date" class="form-control" id="inputPassword4" name="fin"
                                                        placeholder="Fin"></center>
                                                <br>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="montant"
                                                        placeholder="Montant"></center>
                                            </div>
                                            <center><input style="width: 100px;" type="submit" class="btn btn-primary" value="Valider"></center>
                                        </form>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Debut</th>
                        <th scope="col">Fin</th>
                        <th scope="col">Montant</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($echeance as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['debut']; ?></a></th>
                        <th scope="row"><a href="#"><?php echo $row['fin']; ?></a></th>
                        <td><?php echo $row['montant']; ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
