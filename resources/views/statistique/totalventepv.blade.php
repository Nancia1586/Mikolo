{{-- data: [
    @foreach ($recette as $row)
        {{ $row->montant }},
    @endforeach
]

Atao entre ' ' raha text
categories: [
    @foreach ($mois as $row)
        '{{ $row->abreviation }}',
    @endforeach
] --}}

@extends('adside')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card">

                <div class="card-body">
                  <h5 class="card-title">Total des ventes par mois par point de vente</span></h5>

                  <form class="row g-3" action="/statistique/totalventepv">
                        <div class="col-12">
                            <select name="idpv" class="form-control">
                                <?php foreach($pointvente as $row){ ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['emplacement']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <select name="annee" class="form-control">
                                <?php foreach($listeannee as $row){ ?>
                                <option value="<?php echo $row['annee']; ?>"><?php echo $row['annee']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Valider">
                        </div>
                    </form>
                  <!-- Line Chart -->
                  {{-- <div id="barChart" style="min-height: 400px;" class="echart"></div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                        echarts.init(document.querySelector("#barChart")).setOption({
                            xAxis: {
                            type: 'category',
                            data: [
                                @foreach ($mois as $row)
                                    '{{ $row->abreviation }}',
                                @endforeach
                            ]
                            },
                            yAxis: {
                            type: 'value'
                            },
                            series: [{
                            data: [
                                @foreach ($liste as $row)
                                    {{ $row->total }},
                                @endforeach
                            ],
                            type: 'bar'
                            }]
                        });
                        });
                    </script> --}}
                  <!-- End Line Chart -->

                  {{-- <br/><br/> --}}

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Mois</th>
                                <th scope="col">Total vente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $vente = 0;
                            ?>
                            <?php foreach($liste as $row){ ?>
                            <tr>
                                <th scope="row"><?php echo $row['nom']; ?></th>
                                <td><?php echo $row['total']; ?></td>
                            </tr>
                            <?php
                                $vente = $vente + $row['total'];
                            ?>
                            <?php } ?>
                            <tr>
                                <th></th>
                                <th><?php echo $vente; ?></th>
                            </tr>
                            <tr>
                                <td>
                                    <a href="/statistique/ventepvpdf?idpv=<?php echo $row['idpointvente']; ?>&&annee=<?php echo $row['annee']; ?>"><button class="btn btn-primary">Exporter en pdf</button></a>
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
