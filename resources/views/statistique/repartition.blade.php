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
                  <h5 class="card-title">Statistique</span></h5>

                  <!-- Line Chart -->
                  <div id="donutChart"></div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#donutChart"), {
                            series: [44, 55, 13, 43, 22],
                            chart: {
                            height: 350,
                            type: 'donut',
                            toolbar: {
                                show: true
                            }
                            },
                            labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                        }).render();
                        });
                    </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
