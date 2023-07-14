@extends('side')
@section('content')
<section class="section">
    <div class="row">
    <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <center><h5 class="card-title">INSERTION</h5></center>

                    <div class="card">
                        <div class="card-body">
                            <a href="/util/listepanier">Liste des produits en panier</a>
                            <br/><br/>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Produit</th>
                                        <th scope="col">Prix</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($produit as $row){ ?>
                                    <tr>
                                        <th scope="row"><?php echo $row['id']; ?></th>
                                        <td><?php echo $row['nom']; ?></td>
                                        <td><?php echo $row['prix']; ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <input type="hidden" name="produit<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" class="form-control" id="produit<?php echo $row['id']; ?>">
                                                    {{-- <button class="btn btn-primary add-button" id="button<?php echo $row['id']; ?>">Ajouter</button> --}}
                                                    <a href="/util/addtocart/<?php echo $row['id']; ?>"><button class="btn btn-primary add-button">Ajouter dans le panier</button></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <script>
                    var panier = Array();

                    document.addEventListener('DOMContentLoaded', function() {
                        var buttons = document.querySelectorAll('.add-button');

                        buttons.forEach(function(button) {
                            button.addEventListener('click', function() {
                                var inputId = this.id.replace('button', 'produit'); // Obtenez l'ID de l'input correspondant
                                var inputValue = document.getElementById(inputId).value; // Obtenez la valeur de l'input

                                panier.push([inputValue,1]);

                                localStorage.setItem('panier',JSON.stringify(panier)); // Enregistrez la valeur dans le localStorage

                                // alert('Valeur enregistrée dans le localStorage : ' + inputValue);
                            });
                        });
                    });

                    </script>

                    <!-- Vertical Form -->
                    {{-- <form class="row g-3">
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="inputNanme4">
                        </div>
                        <div class="col-12">
                            <label for="inputEmail4" class="form-label">Prenoms</label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-12">
                            <label for="inputPassword4" class="form-label">Date de naissance</label>
                            <input type="password" class="form-control" id="inputPassword4">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Genre</label>
                            <select name="genre" class="form-control">
                                <option value="1">Homme</option>
                                <option value="2">Femme</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Niveau d'etude</label>
                            <select name="genre" class="form-control">
                                <option value="1">CEPE</option>
                                <option value="2">BEPC</option>
                                <option value="2">BACC</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Valider">
                        </div>
                    </form><!-- Vertical Form --> --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
