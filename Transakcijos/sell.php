<?php

include('../server.php');
include('../button.php');
include('../operations.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KaukoCoinEx</title>
    <link rel ="stylesheet" type="text/css" href="style.css">
    <!-- Nuorodos į bootstrap failą, iconų failą -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<br>
<main>
<div class="container text-center">
    <div class="d-flex justify-content-center">
        <form action="" method="post" class="w-50">
            <div class="row">
                <div class="col">
                    <?php inputElement("Rinkos kaina", "price",rFormule()); ?>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col">
                    <?php inputElement("Kiekis", "quantity",""); ?>
                </div>
                <div class="col">
                    <?php inputElement("Data", "timestampx",date("Y/m/d")); ?>
                </div>
            </div>
            <div class="d-flex justify-content-center">

                <?php buttonElement("btn-pardavimas","btn btn-light","<i class='fas fa-sync'></i>","pardavimas","data-toggle='tooltip' data-placement='bottom' title='Pardavimas'"); ?>
            </div>

        </form>
    </div>
</div>
</main>
<!-- Js includes -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="../Transakcijos/main.js"></script>
</body>