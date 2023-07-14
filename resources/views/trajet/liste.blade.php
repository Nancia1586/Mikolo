@extends('side')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Liste trajet</h5>
                        </div>
                        <div class="col-md-7">

                        </div>
                        <div class="col-md-2">
                            <br/>
                            <div class="col-md-12">
                                <a href="/trajet/addform"><button style="width: 150px;" type="button" class="btn btn-success">Nouveau</button></a>
                            </div>
                        </div>
                    </div>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Motif</th>
                        <th scope="col">Depart</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Vehicule</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($trajet as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['datedebut']; ?></a></th>
                        <td><?php echo $row['motif']; ?></td>
                        <td><?php echo $row['lieudebut']; ?></td>
                        <td><?php echo $row['lieufin']; ?></td>
                        <td><?php echo $row['numero']; ?></td>
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
