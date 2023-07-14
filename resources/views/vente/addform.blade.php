@extends('side')
@section('content')
<section class="section">
    <div class="row">
    <div class="col-lg-6" style="margin-left: 300px;">

            <div class="card">
                <div class="card-body">
                    <center><h5 class="card-title">INSERTION VENTE</h5></center>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="/vente/add" method="get">
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Client</label>
                            <select name="client" class="form-control">
                                <?php foreach($client as $row){ ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nom']; ?> (<?php echo $row['contact']; ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Valider">
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
