<?php
include('server.php');
include('button.php');
include('operations.php');

    if(empty($_SESSION['username'])) {
        header('location:login.php');
    }

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
<main>
    <div class="header">
        <h2>KaukoCoinEx</h2>
    </div>
        <div class="content">
            <form action="" method="post" class="noborder">
                <div class="d-flex justify-content-center">
                    <?php buttonElement("btn-pirkimas","btn btn-light","<i class=\"fas fa-chart-pie\"></i>","pirkimas","data-toggle='tooltip' data-placement='bottom' title='Visi duomenys'"); ?>
                    <?php buttonElement("btn-pardavimas2","btn btn-light","<i class=\"fas fa-comment-dollar\"></i>","pardavimas2","data-toggle='tooltip' data-placement='bottom' title='Pardavimas'"); ?>
                    <?php buttonElement("btn-perleidimas2","btn btn-light","<i class='fas fa-pen-alt'></i>","perleidimas2","data-toggle='tooltip' data-placement='bottom' title='Perleidimas'"); ?>
                </div>
            </form>
            <?php if(isset($_SESSION['success'])): ?>
                <div class="error success">
                    <h3>
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </h3>
                </div>
            <?php endif ?>

            <?php

            $uploaduser = $_SESSION["username"];
            $selectuser = mysqli_query($db, "SELECT * FROM users WHERE username='$uploaduser'");
            $row = mysqli_fetch_array($selectuser);
            ?>

            <?php if (isset($_SESSION["username"])): ?>
                <p>Prisijungęs vartotojas: <strong><?php echo $_SESSION['username']; ?> </strong></p>

                <p>Jūsų turimas <strong>KCE</strong> kiekis: <strong><?php echo $row['kce']; ?></strong></p>
                <p>Jūsų turima <strong>USD</strong> Valiuta: <strong><?php echo $row['usd']; ?></strong></p>

                <p><a href="index.php?logout='1'" style="color: red;">Atsijungti</a></p>
            <?php endif ?>
        </div>
        <?php
        $result = getData();
        $i = 0;
        if($result){while ($row = mysqli_fetch_assoc($result))
        {
        $i++;
        if ($i > 0){
        ?>
        <div class="d-flex justify-content-center table-data">
            <table class="table table-striped table-bordered table-secondary header-fixed">
                <thead class="thead-secondary">
                <tr>
                    <th>Įrašo NR</th>
                    <th>Data</th>
                    <th>Kaina</th>
                    <th>Kiekis</th>
                    <th>Parduoda</th>
                    <th>Pirkimas</th>
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
                $result = getData();
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
                            <td data-id="<?php echo $row['id']; ?>"><?php echo $row['userx']; ?></td>
                            <td>
                                <?php
                                if (isset($_POST[$row['id']]))
                                {
                                    $uploaduser = $_SESSION["username"];
                                    $selectuser = mysqli_query($db, "SELECT * FROM users WHERE username='$uploaduser'");
                                    $rowx = mysqli_fetch_array($selectuser);

                                    if($rowx['usd'] >=  $row['price'])
                                    {
                                        $kint = $row['quantity'];
                                        $kint2 = $rowx['username'];
                                        $kint3 = $row['price'];
                                        $kint4 = $row['userx'];

                                        $sql = "
                                                     UPDATE users SET kce = kce + '$kint', usd = usd - '$kint3' WHERE username='$kint2';                    
                                                                                                        ";
                                        if (mysqli_query($GLOBALS['db'], $sql))
                                        {
                                            $sql = "
                                                     UPDATE users SET usd = usd + '$kint3' WHERE username='$kint4';                    
                                                                                                        ";

                                            if (mysqli_query($GLOBALS['db'], $sql))
                                            {
                                                $idas = $row['id'];

                                                $sql = "DELETE FROM btc WHERE id= $idas";

                                                if (mysqli_query($GLOBALS['con'], $sql)) {
                                                    Text("success", "Sėkmingai nusipirkote šio pardavėjo KCE!");
                                                } else {
                                                    Text("error", "Nepavyko nusipirkti KCE!");
                                                }
                                            }

                                        }
                                    }
                                    else
                                    {
                                        Text("error","Turite nepakankamai USD valiutos savo paskyroje!");
                                    }

                                }
                                ?>
                                <form method="post" class="funny">
                                    <input type="submit" name="<?php echo $row['id']; ?>"
                                          data-id="<?php echo $row['id']; ?> " value="<?php echo $row['id']; ?>" />
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>

</main>
    <!-- Js includes -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../KaukoCoinEx/Transakcijos/main.js"></script>
</body>
</html>