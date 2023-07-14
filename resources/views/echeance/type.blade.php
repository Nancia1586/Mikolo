@extends('side')
@section('content')
<section class="section">
    <div class="row">
    <div class="col-lg-6" style="margin-left: 300px;">

            <div class="card">
                <div class="card-body">
                    <center><h5 class="card-title">TYPE DE L'ECHEANCE</h5></center>

                    <!-- Vertical Form -->
                    <form action="/echeance/liste" class="row g-3">
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Selectionnez un type</label>
                            <select name="type" class="form-control">
                                <?php foreach($type as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['type']; ?></option>
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
