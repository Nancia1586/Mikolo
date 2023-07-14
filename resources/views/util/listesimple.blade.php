@extends('side')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-3">
                <h5 class="card-title">Liste</h5>
            </div>
            <div class="col-md-12">
                <button style="width: 100px;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addService">Nouveau</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addService" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Nouveau</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="col-md-12" style="height: 20px;">

                        </div>
                        <form action="/client/add" method="get" class="row g-3">
                            <div>
                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="nom"
                                                        placeholder="Nom"></center>
                                <br>
                                <center><input style="width: 400px;" type="text" name="adresse" class="form-control" id="inputPassword4" name="nom"
                                                        placeholder="Adresse"></center>
                                <br>
                                <center><input style="width: 400px;" type="text" name="email" class="form-control" id="inputPassword4" name="nom"
                                                        placeholder="Email"></center>
                                <br>
                                <center>
                                    <select style="width: 400px;" name="genre" class="form-control">
                                        <option value="">Selectionnez un genre</option>
                                        <option value="1">Homme</option>
                                        <option value="2">Femme</option>
                                    </select>
                                </center>
                            </div>
                            <center><input style="width: 100px;" type="submit" class="btn btn-primary" value="Ajouter"></center>
                        </form>
                        <div class="col-md-12" style="height: 20px;">

                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="card">
                <div class="card-body" style="width: 1300px;">
                    <table class="table table-striped">
                        <thead>
                            <form action="/client/add" method="get" class="row g-3">
                            <tr>
                                <th scope="col">
                                    <input type="text" class="form-control" id="inputPassword4" name="nom">
                                </th>
                                <th scope="col">
                                    <input type="text" class="form-control" id="inputPassword4" name="nom">
                                </th>
                                <th scope="col">
                                    <input type="text" class="form-control" id="inputPassword4" name="nom">
                                </th>
                                <th scope="col">
                                    <input type="text" class="form-control" id="inputPassword4" name="nom">
                                </th>
                                <th scope="col">
                                    <input type="text" class="form-control" id="inputPassword4" name="nom">
                                </th>
                                <th scope="col">
                                    <input type="text" class="form-control" id="inputPassword4" name="nom">
                                </th>
                                <th scope="col">
                                    <input type="submit" value="Rechercher" class="btn btn-primary">
                                </th>
                            </tr>
                            </form>
                        </thead>
                        <br/>
                        <thead>
                            <tr>
                                <th scope="col">Service</th>
                                <th scope="col">Marge (en %)</th>
                                <th scope="col">Revient salarial</th>
                                <th scope="col">Revient materiel</th>
                                <th scope="col">Benefice</th>
                                <th scope="col">Prix de vente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Moteur</td>
                                <td>20</td>
                                <td>60000</td>
                                <td>110000</td>
                                <td>30000</td>
                                <td>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <a href="details_service.html"><button type="button" class="btn btn-primary">Details</button></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
