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
                            <h5 class="card-title">Historique des ventes</h5>
                        </div>
                        <div class="col-md-5">

                        </div>
                        <div class="col-md-2">
                            <br/>
                            <div class="col-md-12">
                                <a href="/vente/listedetaillee"><button style="width: 150px;" type="button"
                                        class="btn btn-success">Liste detaillée</button></a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <br/>
                            <div class="col-md-12">
                                <a href="/vente/addform"><button style="width: 150px;" type="button"
                                        class="btn btn-success">Nouveau</button></a>
                            </div>
                            <!-- Modal -->

                        </div>
                    </div>

                    <br/>
                  <table class="table table-borderless">
                    <thead>

                    {{-- Recherche multicritere --}}
                     <form action="/vente/liste">
                     <tr>
                        <th scope="col">
                            <input type="text" name="date" class="form-control" placeholder="Date">
                        </th>
                        <th scope="col">
                            <input type="text" name="nom" class="form-control" placeholder="Nom">
                        </th>
                        <th scope="col">
                            <input type="text" name="contact" class="form-control" placeholder="Contact">
                        </th>
                        <th>
                            <input type="submit" value="Rechercher" class="btn btn-primary">
                        </th>

                      </tr>
                      </form>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Nom client</th>
                        <th scope="col">Contact client</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($vente as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['date']; ?></a></th>
                        <td><?php echo $row['nom']; ?></td>
                        <td><a href="#" class="text-primary"><?php echo $row['contact']; ?></a></td>
                        <td>
                            <a href="/vente/listedetail?idvente=<?php echo $row['id']; ?>"><button style="width: 150px;" type="button" class="btn btn-primary">Details</button></a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <?php echo $vente->links(); ?>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
