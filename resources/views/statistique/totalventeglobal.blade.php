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
                  <h5 class="card-title">Total des ventes par mois</span></h5>

                  <form class="row g-3" action="/statistique/totalventeglobal">
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
                  <div id="lineChart"></div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#lineChart"), {
                            series: [{
                            name: "Benefice",
                            data: [
                                @foreach ($liste as $row)
                                    {{ $row->total }},
                                @endforeach
                            ]
                            }],
                            chart: {
                            height: 350,
                            type: 'line',
                            zoom: {
                                enabled: false
                            }
                            },
                            dataLabels: {
                            enabled: false
                            },
                            stroke: {
                            curve: 'straight'
                            },
                            grid: {
                            row: {
                                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                            },
                            xaxis: {
                            categories: [
                                @foreach ($mois as $row)
                                    '{{ $row->abreviation }}',
                                @endforeach
                            ],
                            }
                        }).render();
                        });
                    </script>
                  <!-- End Line Chart -->

                  <br/><br/>

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
                                    <a href="/statistique/venteglobalpdf?annee=<?php echo $row['annee']; ?>"><button class="btn btn-primary">Exporter en pdf</button></a>
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
