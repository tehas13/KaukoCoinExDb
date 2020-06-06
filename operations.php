<?php
require_once ("server.php");

$con = mysqli_connect('localhost', 'root', '', 'kaukocoinextransakcijos');
$con->set_charset('utf8mb4');

if (!$con) {
    echo "Connection failed!";
}

if(isset($_POST['pirkimas'])) { pirkimas(); }

if(isset($_POST['pardavimas'])) { pardavimas(); }

if(isset($_POST['pardavimas2'])) { pardavimas2(); }

if(isset($_POST['perleidimas'])) { perleidimas(); }

if(isset($_POST['perleidimas2'])) { perleidimas2(); }

function textboxValue($value)
{
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($textbox))
    {
        return false;
    }
    else
    {
        return $textbox;
    }
}

function Text($classname, $msg)
{
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}

function pardavimas()
{
    $quantity = textboxValue("quantity");
    $price = textboxValue("price");
    $year = date("Y/m/d");
    $userx = $_SESSION['username'];

    if($quantity) {
       if(textboxValue("quantity") != is_numeric($quantity)) {
            Text("error", "Blogai įvestas kiekis, standartas yra: 00.000!");
        } else {

            $sql = "INSERT INTO btc (price, quantity, year, userx) 
                        VALUES ('$price','$quantity','$year','$userx')";

           $sqlx = "INSERT INTO btcall (price, quantity, year) 
                        VALUES ('$price','$quantity','$year')";

           $uploaduser = $_SESSION["username"];
           $selectuser = mysqli_query($GLOBALS['db'], "SELECT * FROM users WHERE username='$uploaduser'");
           $row = mysqli_fetch_array($selectuser);

           if($row['kce'] >= $quantity)
           {
               if (mysqli_query($GLOBALS['con'], $sql) && mysqli_query($GLOBALS['con'], $sqlx))
               {
                   $newquantity = $row['kce'] - $quantity;

                   $sql = "
                                    UPDATE users SET kce='$newquantity' WHERE username='$uploaduser';                    
                        ";

                   if (mysqli_query($GLOBALS['db'], $sql))
                   {
                       header('Location: ../index.php');
                       Text("success", "Sukurtas naujas įrašas!");
                   }
               }
               else
               {
                   Text("error", "Klaida!");
               }
           }
           else
           {
               Text("error", "Neturite tokio KCE kiekio pardavimui!");
           }
        }
    }
    else
    {
        Text("error", "Trūksta duomenų arba yra klaidų!");
    }
}

function pardavimas2()
{
    header('Location: ../KaukoCoinEx/Transakcijos/sell.php');
}

function pirkimas()
{
    header('Location: ../KaukoCoinEx/Transakcijos/index.php');
}

function perleidimas2()
{
    header('Location: ../KaukoCoinEx/Transakcijos/transfer.php');
}

function perleidimas()
{
    $quantity = textboxValue("quantity");
    $user = textboxValue("user");

    if($quantity && $user) {
        if(textboxValue("quantity") != is_numeric($quantity)) {
            Text("error", "Blogai įvestas kiekis, standartas yra: 00.000!");
        } else {
            $uploaduser = $_SESSION["username"];
            $selectuser = mysqli_query($GLOBALS['db'], "SELECT * FROM users WHERE username='$uploaduser'");
            $row = mysqli_fetch_array($selectuser);
            if($row['kce'] >= $quantity)
            {
                $userx = mysqli_real_escape_string($GLOBALS['db'], $_POST['user']);
                $query = "SELECT * FROM users WHERE username='$userx'";
                $result = mysqli_query($GLOBALS['db'], $query);
                if(mysqli_num_rows($result) == 1)
                {
                    $sql = "
                                    UPDATE users SET kce = kce + '$quantity' WHERE username='$user';                    
                        ";
                    if (mysqli_query($GLOBALS['db'], $sql)) {
                        $sql = "
                                    UPDATE users SET kce = kce - '$quantity' WHERE username='$uploaduser';                    
                        ";
                        if (mysqli_query($GLOBALS['db'], $sql)) {
                            header('Location: ../index.php');
                            Text("success", "Pervedimas padarytas!");
                        }
                    } else {
                        echo "Klaida!";
                    }
                }
                else
                {
                    Text("success", "Nera tokio vartotojo!");
                }
            }
            else
            {
                Text("error", "Neturite tiek KCE savo paskyroje!");
            }
        }
    }
    else
    {
        Text("error", "Trūksta duomenų arba yra klaidų!");
    }
}

function rFormule()
{
    $sql = "SELECT price FROM btcall ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($GLOBALS['con'], $sql);

    while ($row = mysqli_fetch_assoc($result))
    {
        return $formule = ($row['price']) + ($row['price'] * RAND(-5,5)/100);
    }

}

function getData()
{
    $sql = "SELECT * FROM btc";

    $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0)
    {
        return $result;
    }
}

function getDataAll()
{
    $sql = "SELECT * FROM btcall";

    $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0)
    {
        return $result;
    }
}
