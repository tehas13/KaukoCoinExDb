<?php

//index.php

include("database_connection.php");
include('../server.php');
include('../button.php');
include('../operations.php');

$query = "SELECT year FROM btcall GROUP BY year DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Rinkos kitimas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel ="stylesheet" type="text/css" href="../style.css">
    <!-- Nuorodos į bootstrap failą, iconų failą -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>
<body>
<br /><br />
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-9">
                    <h3 class="panel-title">Rinkos kitimas pagal pasirinkta datą:</h3>
                </div>
                <div class="col-md-3">
                    <select name="year" class="form-control" id="year">
                        <option value="">Rinktis</option>
                        <?php
                        foreach($result as $row)
                        {
                            echo '<option value="'.$row["year"].'">'.$row["year"].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div id="chart_area" style="width: 1000px; height: 620px;"></div>
        </div>

        <?php
        $result = getData();
        $i = 0;
        if($result)
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                $i++;
                if ($i > 0)
                {
                ?>
                <div class="d-flex justify-content-center table-data">
                    <table class="table table-striped table-bordered table-secondary header-fixed">
                        <thead class="thead-secondary">
                        <tr>
                            <th>Įrašo NR</th>
                            <th>Data</th>
                            <th>Kaina</th>
                            <th>Kiekis</th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                        <?php
                        break;
                }
            }
        }
        ?>

        <?php
            $result = getDataAll();
            if($result)
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    ?>
                    <tr>
                        <td data-id="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></td>
                        <td data-id="<?php echo $row['id']; ?>"><?php echo $row['year']; ?></td>
                        <td data-id="<?php echo $row['id']; ?>"><?php echo $row['price'] . ' €'; ?></td>
                        <td data-id="<?php echo $row['id']; ?>"><?php echo $row['quantity']; ?></td>
                    </tr>
                    <?php
                }
            }
        ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
</body>
</html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback();

    function load_monthwise_data(year, title)
    {
        var temp_title = title + ' '+year+'';
        $.ajax({
            url:"fetch.php",
            method:"POST",
            data:{year:year},
            dataType:"JSON",
            success:function(data)
            {
                drawMonthwiseChart(data, temp_title);
            }
        });
    }

    function drawMonthwiseChart(chart_data, chart_main_title)
    {
        var jsonData = chart_data;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Data');
        data.addColumn('number', 'Kaina');
        $.each(jsonData, function(i, jsonData){
            var year = jsonData.year;
            var price = parseFloat($.trim(jsonData.price));
            data.addRows([[year, price]]);
        });
        var options = {
            title:chart_main_title,
            hAxis: {
                title: "Data"
            },
            vAxis: {
                title: 'Kaina'
            }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
        chart.draw(data, options);
    }

</script>

<script>

    $(document).ready(function(){

        $('#year').change(function(){
            var year = $(this).val();
            if(year != '')
            {
                load_monthwise_data(year, 'Rinkos kainos kitimas: ');
            }
        });

    });

</script>
