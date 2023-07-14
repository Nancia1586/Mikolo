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

<?php
    use App\Models\Commission;
    use App\Models\Util;
?>
@extends('adside')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card">

                <div class="card-body">
                  <h5 class="card-title">Benefice par mois</span></h5>

                  <form class="row g-3" action="/statistique/benefice">
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
                  {{-- <div id="lineChart"></div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#lineChart"), {
                            series: [{
                            name: "Benefice",
                            data: [
                                @foreach ($liste as $row)
                                    {{ $row->benefice }},
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
                    </script> --}}
                  <!-- End Line Chart -->


                  <!-- Pie Chart -->
              {{-- <div id="pieChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#pieChart"), {
                    series: [
                        @foreach ($liste as $row)
                                    {{ $row->benefice }},
                                @endforeach
                    ],
                    chart: {
                      height: 350,
                      type: 'pie',
                      toolbar: {
                        show: true
                      }
                    },
                    labels: [
                        @foreach ($mois as $row)
                                    '{{ $row->abreviation }}',
                                @endforeach
                    ]
                  }).render();
                });
              </script> --}}
              <!-- End Pie Chart -->

              <br/>
                  <!-- Pie Chart -->
              {{-- <div id="pieChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#pieChart")).setOption({
                    title: {
                      text: 'Diagramme des benefices par mois',
                      subtext: '',
                      left: 'center'
                    },
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      orient: 'vertical',
                      left: 'left'
                    },
                    series: [{
                      name: 'Benefice du mois',
                      type: 'pie',
                      radius: '50%',
                      data: [
                        @foreach ($liste as $row)
                            {
                                value:{{ $row->benefice }},
                                name:'{{ $row->nom }}',
                            },
                        @endforeach
                      ],
                      emphasis: {
                        itemStyle: {
                          shadowBlur: 10,
                          shadowOffsetX: 0,
                          shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                      }
                    }]
                  });
                });
              </script> --}}
              <!-- End Pie Chart -->

                  <br/><br/>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Mois</th>
                                <th scope="col">Vente</th>
                                <th scope="col">Achat</th>
                                <th scope="col">Benefice brute</th>
                                <th scope="col">Perte</th>
                                <th scope="col">Benefice</th>
                                <th scope="col">Commission</th>
                                <th scope="col">Benefice apres commission</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $vente = 0;
                                $achat = 0;
                                $beneficebrute = 0;
                                $perte = 0;
                                $benefice = 0;
                                $commission = 0;
                                $beneficeapcom = 0;
                            ?>
                            <?php foreach($liste as $row){ ?>
                            <tr>
                                <th><?php echo $row['nom']; ?></th>
                                <td><?php echo Util::format($row['totalvente']); ?></td>
                                <td><?php echo Util::format($row['totalachat']); ?></td>
                                <td><?php echo Util::format($row['beneficebrute']); ?></td>
                                <td><?php echo Util::format($row['perte']); ?></td>
                                <td><?php echo Util::format($row['benefice']); ?></td>
                                <td><?php echo Util::format(Commission::totalcommission($row['mois'],$row['annee'],$row['totalvente'])); ?></td>
                                <td><?php echo Util::format($row['benefice'] - Commission::totalcommission($row['mois'],$row['annee'],$row['totalvente'])); ?></td>
                            </tr>
                            <?php
                                $vente = $vente + $row['totalvente'];
                                $achat = $achat + $row['totalachat'];
                                $beneficebrute = $beneficebrute + $row['beneficebrute'];
                                $perte = $perte + $row['perte'];
                                $benefice = $benefice + $row['benefice'];
                                $commission = $commission + Commission::totalcommission($row['mois'],$row['annee'],$row['totalvente']);
                                $beneficeapcom = $beneficeapcom + $row['benefice'] - Commission::totalcommission($row['mois'],$row['annee'],$row['totalvente']);
                            ?>
                            <?php } ?>
                            <tr>
                                <th></th>
                                <th><?php echo Util::format($vente); ?></th>
                                <th><?php echo Util::format($achat); ?></th>
                                <th><?php echo Util::format($beneficebrute); ?></th>
                                <th><?php echo Util::format($perte); ?></th>
                                <th><?php echo Util::format($benefice); ?></th>
                                <th><?php echo Util::format($commission); ?></th>
                                <th><?php echo Util::format($beneficeapcom); ?></th>
                            </tr>
                            <tr>
                                <td>
                                    <a href="/statistique/beneficepdf?annee=<?php echo $row['annee']; ?>"><button class="btn btn-primary">Exporter en pdf</button></a>
                                </td>
                                {{-- <td>
                                    <a href="/statistique/beneficecsv?annee=<?php //echo $row['annee']; ?>"><button class="btn btn-primary">Exporter en csv</button></a>
                                </td> --}}
                            </tr>
                        </tbody>
                    </table>

                </div>
              </div>
            </div>
    </div>
</section>
@endsection
