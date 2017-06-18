<?php

session_start();
require 'connect.php';
require 'data.php';

if (!isset($_SESSION['log'])) {
    exit('Autoriseerimata isikule ei lubata juurdepääsu.');
}


echo '<br>';

//Converting a string to an array

$data3 = substr($data3,1,-1);

$data3 = explode(",", $data3);

echo '<a href="index.php?action=logout">Logout</a>'
?>

<!DOCTYPE html>

<html>

<head>

    <title>HighChart</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>

</head>

<body>


<script type="text/javascript">

//    Highchart is used to show data


    $(function () {


        var data_click = <?php echo $data; ?>;

        var data_viewer = <?php echo $data2; ?>;


        $('#container').highcharts({

            chart: {

                type: 'line'

            },

            title: {

                text: 'Andmebaasi salvestatud suvalised andmed'

            },

            xAxis: {

                categories: data_click

            },

            yAxis: {

                //min and max do not work for some reason

                min: -20,

                max: 90,

                title: {

                    text: 'Temperatuurid'

                }

            },

            series: [{

                name: 'Suvalised andmed',

                data: data_viewer

            }]

        });

    });


</script>


<div class="container">

    <br/>

    <h2 class="text-center">Temperatuuride graafik</h2>

    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-heading">Graafik</div>

                <div class="panel-body">

                    <div id="container"></div>

                </div>

            </div>

        </div>

    </div>

</div>

<!--A table for the temperature averages-->

<div class="container">

    <h2 class="text-center">Eelmiste tundide keskmised</h2>

    <div class="col-md-10 col-md-offset-1">

        <table>
            <tr>
                <td>1 tund tagasi</td>
                <td>2 tundi tagasi</td>
                <td>3 tundi tagasi</td>
                <td>4 tundi tagasi</td>
                <td>5 tundi tagasi</td>
                <td>6 tundi tagasi</td>
                <td>7 tundi tagasi</td>
                <td>8 tundi tagasi</td>
                <td>9 tundi tagasi</td>
                <td>10 tundi tagasi</td>
                <td>11 tundi tagasi</td>
                <td>12 tundi tagasi</td>
            </tr>
            <tr>
                <td><?php echo $data3[0] ?></td>
                <td><?php echo $data3[1] ?></td>
                <td><?php echo $data3[2] ?></td>
                <td><?php echo $data3[3] ?></td>
                <td><?php echo $data3[4] ?></td>
                <td><?php echo $data3[5] ?></td>
                <td><?php echo $data3[6] ?></td>
                <td><?php echo $data3[7] ?></td>
                <td><?php echo $data3[8] ?></td>
                <td><?php echo $data3[9] ?></td>
                <td><?php echo $data3[10] ?></td>
                <td><?php echo $data3[11] ?></td>
            </tr>
        </table>

    <div>

</div>


</body>

</html>