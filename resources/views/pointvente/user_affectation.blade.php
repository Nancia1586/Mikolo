@extends('adside')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Liste des utilisateurs libres</h5>
                        </div>
                        <div class="col-md-7">

                        </div>

                  <table class="table table-borderless">
                    <thead>

                    {{-- Recherche multicritere --}}
                     <form action="/pointvente/user_affectation">
                     <tr>
                        <th scope="col">
                            <input type="text" name="nom" class="form-control" placeholder="Nom">
                        </th>
                        <th scope="col">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </th>
                        <th>
                            <input type="submit" value="Rechercher" class="btn btn-primary">
                        </th>
                        <th></th>
                      </tr>
                      </form>
                      <tr>
                        <th></th>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        <form action="/pointvente/affectation" method="get">
                            <?php foreach($utilisateur as $row){ ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="idpv" value="<?php echo $idpv; ?>">
                                    <input type="checkbox" name="user<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
                                </td>
                                <th scope="row"><a href="#"><?php echo $row['nom']; ?></a></th>
                                <td><?php echo $row['email']; ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td>
                                    <input type="submit" value="Valider" class="btn btn-primary">
                                </td>
                            </tr>
                        </form>
                    </tbody>
                  </table>
                  <?php echo $utilisateur->links(); ?>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
