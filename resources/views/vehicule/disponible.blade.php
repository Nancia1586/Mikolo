@extends($side)
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Liste vehicule disponible</h5>
                        </div>
                    </div>


                    <form action="/vehicule/disponible?side=<?php echo $side; ?>" method="get" class="row g-3">
                        <div class="col-12">
                            <input type="date" class="form-control" id="inputNanme4" name="date">
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Voir">
                        </div>
                    </form>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Numero</th>
                        <th scope="col">Marque</th>
                        <th scope="col">Modele</th>
                        <th scope="col">Type</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($dispo as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['numero']; ?></a></th>
                        <td><?php echo $row['marque']; ?></td>
                        <td><a href="#" class="text-primary"><?php echo $row['modele']; ?></a></td>
                        <td><?php echo $row['type']; ?></td>
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
