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
                    </div>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Numero</th>
                        <th scope="col">Marque</th>
                        <th scope="col">Modele</th>
                        <th scope="col">Type</th>
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
                            <form action="/echeance/type" method="get">
                                <input type="hidden" name="idvehicule" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Mettre à jour" class="btn btn-success">
                            </form>
                        </td>
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
