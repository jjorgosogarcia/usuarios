<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$id = Request::get("ID");
$usuarios = $gestor->get($id);
//var_dump($gestor->getValuesSelect());

$sesion = new Session();
$usuario = $sesion->get("email");

//echo $usuario;

$usuarioAdmin = $gestor->get($usuario);

//echo "<hr><hr>".$usuarioAdmin->getAdministrador()."<hr><hr>";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/estilos.css" rel="stylesheet">
    </head>
    <body>
        <h2>Admin: <?php echo $admin, $usuario ?>, Personal: <?php echo $personal ?> Usuario: <?php echo $user ?></h2>
       <form action="../controlUsuario/phpedit.php" method="POST">
                           <div class="logo"></div>
                <div class="login-block">
            <input type="hidden" name="email" value="<?php echo $usuarios->getEmail()?>" /><br />
            <span class="labels">Email<sup>*</sup></span><input type="text" name="email" value="<?php echo $usuarios->getEmail();?>"/><br />
            </span><input type="hidden" name="clave" value="<?php echo $usuarios->getClave();?>" /><br />
            <span class="labels">Alias<sup>*</sup></span><input type="text" name="alias" value="<?php echo $usuarios->getAlias();?>"/><br />
            <input type="hidden" name="fechaalta" value="<?php echo $usuarios->getFechaalta();?>" /><br />
          
            <?php 
            if ($usuarios->getActivo()==0){
            ?>
                <label for="activo">Usuario Activo: </label>
                Si<input type="radio" name="activo" value="1" />
                No<input type="radio" name="activo" value="0" checked="checked" /><br/>
            <?php }else{?>
                <label for="activo">Usuario Activo: </label>
                Si<input type="radio" name="activo" value="1" checked="checked"/>
                No<input type="radio" name="activo" value="0"/><br/>
            <?php }
            if ($usuarios->getPersonal()==0){
            ?>
                 <label for="personal">Personal: </label>
                Si<input type="radio" name="personal" value="1" />
                No<input type="radio" name="personal" value="0" checked="checked" /><br/>
            <?php }else{?>
                <label for="personal">Personal: </label>
                Si<input type="radio" name="personal" value="1" checked="checked" />
                No<input type="radio" name="personal" value="0" /><br/>
            <?php }
            if($usuarioAdmin->getAdministrador()==1){
            if ($usuarios->getAdministrador()==0){
            ?>
                <label for="administrador">Administrador: </label>
                Si<input type="radio" name="administrador" value="1" />
                No<input type="radio" name="administrador" value="0" checked="checked" /><br/>
            <?php }else{?>
                <label for="administrador">Administrador: </label>
                Si<input type="radio" name="administrador" value="1" checked="checked" />
                No<input type="radio" name="administrador" value="0" /><br/>
            <?php }}else{}?>
            <input type="hidden" name="pkID" value="<?php echo $usuarios->getEmail();?>" /><br/>
            <input class="botonEditar" type="submit" value="editar"/>
            <a href="index.php"><button type="button">Atras</button></a>
                </div>
        </form>
       
    </body>
</html>
<?php
$bd->close();
