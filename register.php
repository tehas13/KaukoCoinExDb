<?php
include ('server.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>KaukoCoinEx</title>
    <link rel ="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
         <h2>Registracija</h2>
    </div>

    <form method="post" action="register.php">
        <?php
        include('errors.php');
        ?>
        <div class="input-group">
            <label>Vardas</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label>El.paštas</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
            <label>Slaptažodis</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label>Pakartoti slaptažodį</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <button type="submit" name="register" class="btn">Registruotis</button>
        </div>
        <p>
            Jau esate narys? <a href="login.php">Prisijungti</a>
        </p>
    </form>

</body>
</html>