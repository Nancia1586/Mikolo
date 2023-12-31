
<style>
            table {
                margin-bottom: 1em;
            }

            table td {
                padding: 3px;
            }

            .table1 {
                border: 1px solid rgb(255, 255, 255);
            }

            .table2,.table2 td {
                border: 1px solid silver;
                border-collapse: collapse;
            }

            .table2 td:first-child {
                background-color: lightblue;
            }

            .CSSTableGenerator {
                margin: 0px;
                padding: 0px;
                width: 100%;
                box-shadow: 10px 10px 5px #888888;
                border: 1px solid #000000;
                -moz-border-radius-bottomleft: 0px;
                -webkit-border-bottom-left-radius: 0px;
                border-bottom-left-radius: 0px;
                -moz-border-radius-bottomright: 0px;
                -webkit-border-bottom-right-radius: 0px;
                border-bottom-right-radius: 0px;
                -moz-border-radius-topright: 0px;
                -webkit-border-top-right-radius: 0px;
                border-top-right-radius: 0px;
                -moz-border-radius-topleft: 0px;
                -webkit-border-top-left-radius: 0px;
                border-top-left-radius: 0px;
            }

            .CSSTableGenerator table {
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
                height: 100%;
                margin: 0px;
                padding: 0px;
            }

            .CSSTableGenerator tr:last-child td:last-child {
                -moz-border-radius-bottomright: 0px;
                -webkit-border-bottom-right-radius: 0px;
                border-bottom-right-radius: 0px;
            }

            .CSSTableGenerator table tr:first-child td:first-child {
                -moz-border-radius-topleft: 0px;
                -webkit-border-top-left-radius: 0px;
                border-top-left-radius: 0px;
            }

            .CSSTableGenerator table tr:first-child td:last-child {
                -moz-border-radius-topright: 0px;
                -webkit-border-top-right-radius: 0px;
                border-top-right-radius: 0px;
            }

            .CSSTableGenerator tr:last-child td:first-child {
                -moz-border-radius-bottomleft: 0px;
                -webkit-border-bottom-left-radius: 0px;
                border-bottom-left-radius: 0px;
            }

            .CSSTableGenerator tr:hover td {

            }

            .CSSTableGenerator tr:nth-child(odd) {
                background-color: #f1f1ff;
            }o

            .CSSTableGenerator tr:nth-child(even) {
                background-color: #ffffff;
            }

            .CSSTableGenerator td {
                vertical-align: middle;
                border: 1px solid #000000;
                border-width: 0px 1px 1px 0px;
                text-align: left;
                padding: 7px;
                font-size: 14px;
                font-family: Arial, Helvetica, sans-serif;
                font-weight: normal;
                color: #000000;
            }

            .CSSTableGenerator tr:last-child td {
                border-width: 0px 1px 0px 0px;
            }

            .CSSTableGenerator tr td:last-child {
                border-width: 0px 0px 1px 0px;
            }

            .CSSTableGenerator tr:last-child td:last-child {
                border-width: 0px 0px 0px 0px;
            }

            /* .CSSTableGenerator tr:first-child td {
                background: -o-linear-gradient(bottom, #ff7f00 5%, #bf5f00 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ff7f00), color-stop(1, #bf5f00));
                background: -moz-linear-gradient(center top, #ff7f00 5%, #bf5f00 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ff7f00", endColorstr="#bf5f00");
                background: -o-linear-gradient(top, #ff7f00, bf5f00);
                background-color:#d1d4dd;
                border: 0px solid #000000;
                text-align: center;
                border-width: 0px 0px 1px 1px;
                font-size: 14px;
                font-family: Arial;
                font-weight: bold;
                color: #ffffff;
            } */

            .CSSTableGenerator tr:first-child:hover td {
                background: -o-linear-gradient(bottom, #ff7f00 5%, #bf5f00 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ff7f00), color-stop(1, #bf5f00));
                background: -moz-linear-gradient(center top, #ff7f00 5%, #bf5f00 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ff7f00", endColorstr="#bf5f00");
                background: -o-linear-gradient(top, #ff7f00, bf5f00);
                background-color: #ff7f00;
            }

            .CSSTableGenerator tr:first-child td:first-child {
                border-width: 0px 0px 1px 0px;
            }
            .CSSTableGenerator tr:first-child td:last-child {
                border-width: 0px 0px 1px 1px;
            }
        </style>

        <div class="col-12" style="font-family: Arial, Helvetica, sans-serif">
              <div class="card">

                <div class="card-body">
                  <h5 class="card-title">Total des ventes par mois</span></h5>

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
                    </script>
                  <!-- End Line Chart -->

                  <br/><br/> --}}

                  <h5>Emplacement: <?php echo $emplacement['emplacement']; ?></h5>
                    <br/>
                    <table border="1" class="CSSTableGenerator">
                        <thead>
                            <tr>
                                <th>Mois</th>
                                <th>Total vente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($liste as $row){ ?>
                            <tr>
                                <td><?php echo $row['nom']; ?></td>
                                <td><?php echo $row['total']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>

              </div>
            </div>

