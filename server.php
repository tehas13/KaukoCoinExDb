<?php
// database connection
    session_start();

    $username = "";
    $email = "";
    $password_1 = "";
    $password_2 = "";
    $errors = array();
    $kce = 10.0;
    $usd = 1000.0;

    $db = mysqli_connect('localhost', 'root', '', 'kaukocoinex');
    $db->set_charset('utf8mb4');

    if(isset($_POST['register'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


        if (empty($username)) {
            array_push($errors, "Įveskite vartotojo vardą");
        }
        if (empty($email)) {
            array_push($errors, "Įveskite elektroninį paštą");
        }
        if (empty($password_1)) {
            array_push($errors, "Įveskite slaptažodį");
        }

        if ($password_1 != $password_2) {
            array_push($errors, "Nesutampa slaptažodis");
        }

        if (count($errors) == 0) {
            $password = md5($password_1);
            $sql = "INSERT INTO users (username, email, password, kce, usd) VALUES ('$username', '$email', '$password', '$kce', '$usd')";
            mysqli_query($db, $sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Sveiki prisijungę prie KaukoCoinEx sistemos";
            header('Location: index.php');
        }
    }
        if(isset($_POST['login'])) {
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $password = mysqli_real_escape_string($db, $_POST['password']);

            if (empty($username)) {
                array_push($errors, "Iveskite vartotojo varda");
            }
            if (empty($password)) {
                array_push($errors, "Įveskite slaptažodį");
            }

            if(count($errors) == 0) {
                $password = md5($password);
                $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                $result = mysqli_query($db, $query);
                if(mysqli_num_rows($result) == 1)
                {
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = "Sveiki prisijungę prie KaukoCoinEx sistemos";
                    header('location: index.php');
                }
                else
                {
                    array_push($errors, "Klaida įvedant vardą/slaptažodį");
                }
            }
        }

        if(isset($_GET['logout'])) {
            session_destroy();
            unset($_SESSION['username']);
            header('location: login.php');
        }
?>