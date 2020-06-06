<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>KaukoCoinEx</title>
    <link rel ="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <h2>Prisijungimas</h2>
</div>

<form method="post" action="login.php">
    <?php
    include('errors.php');
    ?>
    <div class="input-group">
        <label>Vardas</label>
        <input type="text" name="username">
    </div>
    <div class="input-group">
        <label>Slaptažodis</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <button type="submit" name="login" class="btn">Prisijungti</button>
    </div>
    <p>
        Vis dar ne narys? <a href="register.php">Registruotis</a>
    </p>
</form>

</body>
</html>












