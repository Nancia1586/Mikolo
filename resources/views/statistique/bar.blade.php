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
                  <div id="barChart" style="min-height: 400px;" class="echart"></div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                        echarts.init(document.querySelector("#barChart")).setOption({
                            xAxis: {
                            type: 'category',
                            data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
                            },
                            yAxis: {
                            type: 'value'
                            },
                            series: [{
                            data: [120, 200, 150, 80, 70, 110, 130],
                            type: 'bar'
                            }]
                        });
                        });
                    </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div>
    </div>

    {{-- Autre --}}
    <div class="row">
        <div class="col-12">
              <div class="card">

                <div class="card-body">
                  <h5 class="card-title">Statistique</span></h5>

                  <!-- Line Chart -->
                  <div id="columnChart"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#columnChart"), {
                        series: [{
                        name: 'Net Profit',
                        data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                        }, {
                        name: 'Revenue',
                        data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                        }, {
                        name: 'Free Cash Flow',
                        data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                        }],
                        chart: {
                        type: 'bar',
                        height: 350
                        },
                        plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                        },
                        dataLabels: {
                        enabled: false
                        },
                        stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                        },
                        xaxis: {
                        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                        },
                        yaxis: {
                        title: {
                            text: '$ (thousands)'
                        }
                        },
                        fill: {
                        opacity: 1
                        },
                        tooltip: {
                        y: {
                            formatter: function(val) {
                            return "$ " + val + " thousands"
                            }
                        }
                        }
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
