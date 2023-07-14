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
                  <h5 class="card-title">Commissions par point de vente</span></h5>

                  <form class="row g-3" action="/statistique/commission">
                        <div class="col-12">
                            <select name="mois" class="form-control">
                                <?php foreach($listemois as $row){ ?>
                                <option value="<?php echo $row['numero']; ?>"><?php echo $row['nom']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <input type="text" name="annee" class="form-control" placeholder="Annee">
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
                                <th scope="col">Point Vente</th>
                                <th scope="col">Commission</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($pointvente as $row){ ?>
                            <tr>
                                <th scope="row"><?php echo $row['emplacement']; ?></th>
                                <td><?php echo Util::format(Commission::montantcommission($mois,$annee,$row['id'])); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
