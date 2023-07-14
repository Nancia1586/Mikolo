
        <?php
            $path='D:\Etudes\S6\EVALUATION\E-Commerce\public\uploads\greve.jpg' ;
            $type=pathinfo($path,PATHINFO_EXTENSION);
            $data=file_get_contents($path);
            $base64='data:image/'.$type.';base64,'.base64_encode($data);
        ?>
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
                font-size: 10px;
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

            .CSSTableGenerator tr:first-child td {
                background: -o-linear-gradient(bottom, #ff7f00 5%, #bf5f00 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ff7f00), color-stop(1, #bf5f00));
                background: -moz-linear-gradient(center top, #ff7f00 5%, #bf5f00 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ff7f00", endColorstr="#bf5f00");
                background: -o-linear-gradient(top, #ff7f00, bf5f00);
                background-color:#9bb2f7;
                border: 0px solid #000000;
                text-align: center;
                border-width: 0px 0px 1px 1px;
                font-size: 14px;
                font-family: Arial;
                font-weight: bold;
                color: #ffffff;
            }

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
       <div class="col-lg-12" style="font-family: Arial, Helvetica, sans-serif">
            <div class="col-md-12">
                <center><h2 class="card-title">Liste des trajets</h2></center>
                <br/>
                <h5 class="card-title">Numero: <?php echo $vehicule[0]['numero']; ?></h5>
                <h5 class="card-title">Marque: <?php echo $vehicule[0]['marque']; ?></h5>
                <h5 class="card-title">Modele: <?php echo $vehicule[0]['modele']; ?></h5>
                <h5 class="card-title">Type: <?php echo $vehicule[0]['type']; ?></h5>
            </div>
            <div class="card">
                    <table border="1" class="CSSTableGenerator">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Motif</th>
                                <th scope="col">Depart</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Chauffeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($trajet as $row){ ?>
                            <tr>
                                <td scope="row"><?php echo $row['datedebut']; ?></td>
                                <td><?php echo $row['motif']; ?></td>
                                <td><?php echo $row['lieudebut']; ?></td>
                                <td><?php echo $row['lieufin']; ?></td>
                                <td><?php echo $row['nom']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
