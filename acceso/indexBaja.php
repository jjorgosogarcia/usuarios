<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$bd = new DataBase();
$gestor = new ManageUser($bd);


$id = $sesion->get("email");
$usuarios = $gestor->get($id);
//echo $usuarios->getEmail();
//var_dump($usuarios);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        <div class="logo"></div>
        <div  class="login-block2">
        <?php 
                if ($usuarios->getActivo()==0){
            ?> 
        <h2>Lo sentimos pero no ha activado la cuenta</h2>
        <?php }if($usuarios->getActivo()==1){ ?>
    
                <h3>Perfil: <?= $usuarios->getEmail()?></h3>
                <img class="avatar" src="../controlUsuario/avatares/<?= $usuarios->getImagen() ?>"></img>
                <span class="plataforma">Alias: <?= $usuarios->getAlias() ?></span>
                <div class="separador"></div>
                <a href="../usuario/editar.php?ID=<?= $usuarios->getEmail() ?>">Editar Perfil</a>
                <a href="../usuario/baja.php?ID=<?= $usuarios->getEmail() ?>">Dar de baja</a>
                </div>
    </body>
</html>
<?php
$bd->close();
   
 } ?>
