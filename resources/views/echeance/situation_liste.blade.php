@extends($side)
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Situation des echeances des vehicules</h5>
                        </div>
                    </div>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Numero</th>
                        <th scope="col">Marque</th>
                        <th scope="col">Modele</th>
                        <th scope="col">Type</th>
                        <th scope="col">Debut</th>
                        <th scope="col">Fin</th>
                        <th scope="col">Expiration</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($liste as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['numero']; ?></a></th>
                        <th scope="row"><?php echo $row['marque']; ?></th>
                        <td scope="row"><?php echo $row['modele']; ?></td>
                        <th scope="row"><?php echo $row['type']; ?></th>
                        <td scope="row"><?php echo $row['debut']; ?></td>
                        <th scope="row"><?php echo $row['fin']; ?></th>
                        <?php if($row['expiration'] >=15 && $row['expiration'] < 30){ ?>
                        <td scope="row" style="background-color: yellow;"><b>dans <?php echo $row['expiration']; ?> jours</b></td>
                        <?php } ?>
                        <?php if($row['expiration'] < 15){ ?>
                        <td scope="row" style="background-color: red;"><b>dans <?php echo $row['expiration']; ?> jours</b></td>
                        <?php } ?>
                        <?php if($row['expiration'] >= 30){ ?>
                        <td scope="row"><b>dans <?php echo $row['expiration']; ?> jours</b></td>
                        <?php } ?>
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
