@extends('side')
@section('content')
<section class="section">
    <div class="row">
    <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <center><h5 class="card-title">PANIER</h5></center>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Produit</th>
                                        <th scope="col">Quantite</th>
                                        <th scope="col">Prix unitaire</th>
                                        <th scope="col">Prix total</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                {{-- <tbody id="panier">

                                </tbody> --}}
                                <tbody>
                                    <?php
                                        $somme = 0;
                                        foreach($panier as $row){
                                        $somme = $somme + $row['prixtotal'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['nom'] ?></td>
                                        <td><?php echo $row['quantite'] ?></td>
                                        <td><?php echo $row['prix'] ?></td>
                                        <td><?php echo $row['prixtotal'] ?></td>
                                        <td>
                                            <a href="/util/increment/<?php echo $row['id']; ?>"><button class="btn btn-primary add-button">+</button></a>
                                            <a href="/util/decrement/<?php echo $row['id']; ?>"><button class="btn btn-primary add-button">-</button></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>TOTAL</td>
                                        <td><?php echo $somme; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            //Afficher les donnees dans le localstorage
                            var tab = JSON.parse(localStorage.getItem('panier'));
                            const panier = document.getElementById('panier');
                            var liste = "";
                            for (i = 0; i < tab.length; i++) {
                            liste = liste + "<tr>"+
                                                "<td>"+tab[i][0]+"</td>"
                                                + "<td><input type='number' name='quantite' value='" + tab[i][1] + "'></td>"
                                            +"</tr>";
                            }
                            panier.innerHTML = liste;
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
