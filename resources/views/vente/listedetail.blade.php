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
                            <h5 class="card-title">Details vente</h5>
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

                    <h6>Date: <?php echo $vente['date']; ?></h6>
                    <h6>Client: <?php echo $vente['nom']; ?></h6>
                    <h6>Contact du client: <?php echo $vente['contact']; ?></h6>
                    <br/>
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
