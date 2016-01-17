<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestorUsuario = new ManageUser($bd);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        <form action="../controlUsuario/phpregister.php" method="POST" >
            <div class="logo"></div>
            <div class="login-block">
             <h1>Registro</h1>
            <label for="email">Email: </label><input type="email" name="email" value="" /><br/>
            <label for="password">Password: </label><input type="password" name="clave" value="" /><br/>           
            <input type="submit" value="Registrar"/>
            <a href="../login/login.php"><button type="button">Atras</button></a>
            </div>
        </form>
    </body>
</html>
<?php
$bd->close();