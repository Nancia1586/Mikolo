@extends('side')
@section('content')
<section class="section">
    <div class="row">
    <div class="col-lg-6" style="margin-left: 300px;">

            <div class="card">
                <div class="card-body">
                    <center><h5 class="card-title">AJOUT TRAJET</h5></center>

                    <!-- Vertical Form -->
                    <form action="/trajet/add" method="get" class="row g-3">
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Motif</label>
                            <textarea type="text" class="form-control" id="inputNanme4" name="motif"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="inputEmail4" class="form-label">Depart</label>
                            <input type="date" class="form-control" id="inputEmail4" name="datedebut">
                            <input type="time" class="form-control" id="inputEmail4" name="heuredebut">
                            <input type="text" class="form-control" id="inputEmail4" placeholder="Lieu" name="lieudebut">
                            <input type="text" class="form-control" id="inputEmail4" placeholder="Kilometrage" name="kilometragedebut">
                        </div>
                         <div class="col-12">
                            <label for="inputEmail4" class="form-label">Destination</label>
                            <input type="date" class="form-control" id="inputEmail4" name="datefin">
                            <input type="time" class="form-control" id="inputEmail4" name="heurefin">
                            <input type="text" class="form-control" id="inputEmail4" placeholder="Lieu" name="lieufin">
                            <input type="text" class="form-control" id="inputEmail4" placeholder="Kilometrage" name="kilometragefin">
                        </div>
                         <div class="col-12">
                            <label for="inputEmail4" class="form-label">Carburant</label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="Montant" name="montantcarburant">
                            <input type="text" class="form-control" id="inputEmail4" placeholder="Quantite" name="quantitecarburant">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Vehicule</label>
                            <select name="vehicule" class="form-control">
                                <?php foreach($vehicule as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['numero']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="inputEmail4" class="form-label">Vitesse moyenne (km/h)</label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="Vitesse moyenne" name="vitessemoyenne">
                        </div>
                        <?php if(isset($erreur)){ ?>
                            <h6 style="color:red;"><?php echo $erreur; ?></h6>
                        <?php } ?>
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
