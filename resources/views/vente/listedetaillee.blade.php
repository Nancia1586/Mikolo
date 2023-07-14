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
                            <h5 class="card-title">Liste des ventes effectués</h5>
                        </div>
                        <div class="col-md-7">

                        </div>
                        <div class="col-md-2">
                            <br/>
                            {{-- <div class="col-md-12">
                                <a href="/vente/addform"><button style="width: 150px;" type="button"
                                        class="btn btn-success">Nouveau</button></a>
                            </div> --}}
                            <!-- Modal -->

                        </div>
                    </div>

                  <table class="table table-borderless">
                    <thead>
                    <form action="/vente/listedetaillee">
                     <tr>
                        <th scope="col">
                            <input type="text" name="reference" class="form-control" placeholder="Reference">
                        </th>
                        <th scope="col">
                            <input type="text" name="prixmin" class="form-control" placeholder="Prix min">
                        </th>
                        <th scope="col">
                            <input type="text" name="prixmax" class="form-control" placeholder="Prix max">
                        </th>
                        <th>
                            <input type="submit" value="Rechercher" class="btn btn-primary">
                        </th>

                      </tr>
                      </form>
                      <tr>
                        <th scope="col">Reference</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">Prix unitaire</th>
                        <th scope="col">Prix total</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($detail as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['reference']; ?></a></th>
                        <td><?php echo $row['quantite']; ?></td>
                        <td><a href="#" class="text-primary"><?php echo $row['prixunitaire']; ?></a></td>
                        <td><a href="#" class="text-primary"><?php echo ($row['prixunitaire'] * $row['quantite']); ?></a></td>
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
