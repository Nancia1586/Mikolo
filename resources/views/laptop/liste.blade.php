<?php
    use App\Models\Util;
?>
@extends('adside')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Liste laptop</h5>
                        </div>
                        <div class="col-md-7">

                        </div>
                        <div class="col-md-2">
                            <br/>
                            <div class="col-md-12">
                                <a href="/laptop/addform"><button style="width: 150px;" type="button"
                                        class="btn btn-success">Nouveau</button></a>
                            </div>
                            <!-- Modal -->

                            {{-- Modal modifier --}}
                            <?php foreach($laptop as $row){ ?>
                            <div class="modal fade" id="modifier<?php echo $row['id']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modification</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/laptop/update" method="get" class="row g-3">
                                            <div>
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="reference"
                                                        placeholder="Reference" value="<?php echo $row['reference']; ?>"></center>
                                                <br>
                                                <center>
                                                    <select style="width: 400px;" name="marque" class="form-control">
                                                        <option value="<?php echo $row['idmarque']; ?>"><?php echo $row['marque']; ?></option>
                                                        <?php foreach($marque as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['marque']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </center>
                                                <br>
                                                <center>
                                                    <label for="inputAddress" class="form-label">Processeur</label>
                                                    <select style="width: 400px;" name="fabriquant" class="form-control">
                                                        <option value="<?php echo $row['idfabriquant']; ?>"><?php echo $row['fabriquant']; ?></option>
                                                        <?php foreach($fabriquant as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['fabriquant']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <select style="width: 400px;" name="core" class="form-control">
                                                        <option value="<?php echo $row['idcoreprocesseur']; ?>"><?php echo $row['core']; ?></option>
                                                        <?php foreach($core as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['core']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputNanme4" name="generation" value="<?php echo $row['generation']; ?>">
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputNanme4" name="nbcoeur" value="<?php echo $row['nbcoeur']; ?>">
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputNanme4" name="frequence" value="<?php echo $row['frequence']; ?>">
                                                </center>
                                                <br>
                                                <center>
                                                    <label for="inputAddress" class="form-label">RAM</label>
                                                    <select style="width: 400px;" name="typeram" class="form-control">
                                                        <option value="<?php echo $row['idtyperam']; ?>"><?php echo $row['typeram']; ?></option>
                                                        <?php foreach($typeram as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['type']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputNanme4" name="capaciteram" value="<?php echo $row['capaciteram']; ?>">
                                                </center>
                                                <center>
                                                    <label for="inputAddress" class="form-label">Ecran</label>
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputNanme4" name="taille" value="<?php echo $row['taille']; ?>">
                                                    <select style="width: 400px;" name="resolution" class="form-control">
                                                        <option value="<?php echo $row['idresolution']; ?>"><?php echo $row['resolution']; ?></option>
                                                        <?php foreach($resolution as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['resolution']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <select style="width: 400px;" name="affichage" class="form-control">
                                                        <option value="<?php echo $row['idaffichage']; ?>"><?php echo $row['affichage']; ?></option>
                                                        <?php foreach($affichage as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['affichage']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </center>
                                                <center>
                                                     <label for="inputAddress" class="form-label">Disque Dur</label>
                                                    <select style="width: 400px;" name="typedisque" class="form-control">
                                                        <option value="<?php echo $row['idtypedisque']; ?>"><?php echo $row['typedisque']; ?></option>
                                                        <?php foreach($typedisque as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['type']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputNanme4" name="capacitedisque" value="<?php echo $row['capacitedisque']; ?>">
                                                </center>
                                                <br/>
                                                <center>
                                                    <label for="inputAddress" class="form-label">Prix de vente</label>
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="prix" value="<?php echo $row['prix']; ?>"
                                                </center>
                                                <br/>
                                                <center>
                                                    <label for="inputAddress" class="form-label">Prix d'achat</label>
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="prixachat" value="<?php echo $row['prixachat']; ?>"
                                                </center>
                                            </div>
                                            <center><input style="width: 100px;" type="submit" class="btn btn-primary" value="Modifier"></center>
                                        </form>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            {{-- Modal supprimer --}}
                            {{-- Modal modifier --}}
                            <?php foreach($laptop as $row){ ?>
                            <div class="modal fade" id="supprimer<?php echo $row['id']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Suppression</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                         <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <center><p>Etes-vous sur de vouloir continuer la suppression?</p></center>
                                        <center><button style="width: 150px;" type="button" data-bs-dismiss="modal" class="btn btn-danger">Annuler</button>
                                        <a href="/laptop/supprimer?id=<?php echo $row['id']; ?>"><button style="width: 150px;" type="button" class="btn btn-primary">Supprimer</button></a></center>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>


                    {{-- Modal recherche multicritere --}}
                    <div class="modal fade" id="recherche" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Recherche multicritere</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/laptop/liste" method="get" class="row g-3">
                                            <div>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="reference"
                                                        placeholder="Reference"></center>
                                                <br>
                                                <center>
                                                    <select style="width: 400px;" name="marque" class="form-control">
                                                        <option value="">Marque</option>
                                                        <?php foreach($marque as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['marque']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </center>
                                                <br>
                                                <center>
                                                    <label for="inputAddress" class="form-label">Processeur</label>
                                                    <select style="width: 400px;" name="fabriquant" class="form-control">
                                                        <option value="">Fabriquant</option>
                                                        <?php foreach($fabriquant as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['fabriquant']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <select style="width: 400px;" name="core" class="form-control">
                                                        <option value="">Core</option>
                                                        <?php foreach($core as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['core']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputNanme4" name="generation" placeholder="Generation">
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputNanme4" name="nbcoeur" placeholder="Nombre de coeur">
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputNanme4" name="frequence" placeholder="Frequence">
                                                </center>
                                                <br>
                                                <center>
                                                    <label for="inputAddress" class="form-label">RAM</label>
                                                    <select style="width: 400px;" name="typeram" class="form-control">
                                                        <option value="">Type ram</option>
                                                        <?php foreach($typeram as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['type']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputNanme4" name="capaciteram" placeholder="Capacite">
                                                </center>
                                                <center>
                                                    <label for="inputAddress" class="form-label">Ecran</label>
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputNanme4" name="taille" placeholder="Taille">
                                                    <select style="width: 400px;" name="resolution" class="form-control">
                                                        <option value="">Resolution</option>
                                                        <?php foreach($resolution as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['resolution']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <select style="width: 400px;" name="affichage" class="form-control">
                                                        <option value="">Affichage</option>
                                                        <?php foreach($affichage as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['affichage']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </center>
                                                <center>
                                                     <label for="inputAddress" class="form-label">Disque Dur</label>
                                                    <select style="width: 400px;" name="typedisque" class="form-control">
                                                        <option value="">Type disque</option>
                                                        <?php foreach($typedisque as $key){ ?>
                                                        <option value="<?php echo $key['id']; ?>"><?php echo $key['type']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input style="width: 400px;" type="text" class="form-control" id="inputNanme4" name="capacitedisque" placeholder="Capacite">
                                                </center>
                                                <br/>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="prix"
                                                        placeholder="Prix maximal"></center>
                                            </div>
                                            <center><input style="width: 100px;" type="submit" class="btn btn-primary" value="Rechercher"></center>
                                        </form>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                    </div>
                                </div>
                            </div>


                    {{-- Recherche multicritere --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#recherche">Recherche multicritere</button>
                    <br/>
                  <table class="table table-borderless">
                    <thead>
                        {{-- Recherche simple --}}
                    <form action="/vehicule/liste">
                     <tr>
                        <th scope="col">
                            <input type="text" name="mot" class="form-control" placeholder="Saisissez">
                        </th>
                        <th>
                            <input type="submit" value="Rechercher" class="btn btn-primary">
                        </th>
                        <th></th>
                        <th></th>
                      </tr>
                    </form>
                      <tr>
                        <th scope="col">Reference</th>
                        <th scope="col">Marque</th>
                        <th scope="col">Processeur</th>
                        <th scope="col">Frequence</th>
                        <th scope="col">Coeur</th>
                        <th scope="col">Ram</th>
                        <th scope="col">Ecran</th>
                        <th scope="col">Disque</th>
                        <th scope="col">Prix vente</th>
                        <th scope="col">Prix achat</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($laptop as $row){ ?>
                    <tr>
                        <th scope="row"><a href="#"><?php echo $row['reference']; ?></a></th>
                        <td><?php echo $row['marque']; ?></td>
                        <td><?php echo $row['fabriquant']." core ".$row['core']." ".$row['generation']."e generation"; ?></td>
                        <td><?php echo $row['frequence']; ?></td>
                        <td><?php echo $row['nbcoeur']; ?></td>
                        <td><?php echo $row['typeram'].",".$row['capaciteram']." GB"; ?></td>
                        <td><?php echo $row['taille']." pouces,".$row['resolution'].",".$row['affichage']; ?></td>
                        <td><?php echo $row['typedisque'].",".$row['capacitedisque']." GB"; ?></td>
                        <td><?php echo Util::format($row['prix']); ?></td>
                        <td><?php echo Util::format($row['prixachat']); ?></td>
                        <td>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modifier<?php echo $row['id']; ?>">Mod</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#supprimer<?php echo $row['id']; ?>">Supp</button>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                  <?php echo $laptop->links(); ?>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
