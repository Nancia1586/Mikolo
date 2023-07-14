@extends('side')
@section('content')
<section class="section">
    <div class="row">
    <div class="col-lg-6" style="margin-left: 300px;">

            <div class="card">
                <div class="card-body">
                    <center><h5 class="card-title">INSERTION</h5></center>

                    <!-- Vertical Form -->
                    <form class="row g-3">
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
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
