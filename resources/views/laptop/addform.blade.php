@extends('adside')
@section('content')
<section class="section">
    <div class="row">
    <div class="col-lg-6" style="margin-left: 300px;">

            <div class="card">
                <div class="card-body">
                    <center><h5 class="card-title">AJOUT LAPTOP</h5></center>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="/laptop/add" method="get">
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Reference</label>
                            <input type="text" class="form-control" id="inputNanme4" name="reference">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Marque</label>
                            <select style="width: 400px;" name="marque" class="form-control">
                                <?php foreach($marque as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['marque']; ?></option>
                                <?php } ?>
                             </select>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Processeur</label>
                            <select style="width: 400px;" name="fabriquant" class="form-control">
                                <?php foreach($fabriquant as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['fabriquant']; ?></option>
                                <?php } ?>
                             </select>
                             <select style="width: 400px;" name="core" class="form-control">
                                <?php foreach($core as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['core']; ?></option>
                                <?php } ?>
                             </select>
                             <input type="text" class="form-control" id="inputNanme4" name="generation" placeholder="Generation">
                             <input type="text" class="form-control" id="inputNanme4" name="nbcoeur" placeholder="Nombre de coeur">
                             <input type="text" class="form-control" id="inputNanme4" name="frequence" placeholder="Frequence">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">RAM</label>
                            <select style="width: 400px;" name="typeram" class="form-control">
                                <?php foreach($typeram as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['type']; ?></option>
                                <?php } ?>
                             </select>
                             <input type="text" class="form-control" id="inputNanme4" name="capaciteram" placeholder="Capacite">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Ecran</label>
                            <input type="text" class="form-control" id="inputNanme4" name="taille" placeholder="Taille">
                            <select style="width: 400px;" name="resolution" class="form-control">
                                <?php foreach($resolution as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['resolution']; ?></option>
                                <?php } ?>
                             </select>
                             <select style="width: 400px;" name="affichage" class="form-control">
                                <?php foreach($affichage as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['affichage']; ?></option>
                                <?php } ?>
                             </select>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Disque Dur</label>
                            <select style="width: 400px;" name="typedisque" class="form-control">
                                <?php foreach($typedisque as $key){ ?>
                                <option value="<?php echo $key['id']; ?>"><?php echo $key['type']; ?></option>
                                <?php } ?>
                             </select>
                             <input type="text" class="form-control" id="inputNanme4" name="capacitedisque" placeholder="Capacite">
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Prix de vente</label>
                            <input type="text" class="form-control" id="inputNanme4" name="prix">
                        </div>
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Prix d'achat</label>
                            <input type="text" class="form-control" id="inputNanme4" name="prixachat">
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
