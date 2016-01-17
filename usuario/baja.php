<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$usuarios = $gestor->getList();

$correo = Request::get("ID");


$usuario = $gestor->get($correo);

foreach ($usuarios as $indice => $usuario) { 
   if($correo == $usuario->getEmail()){
       $usuario->setActivo(0);
         $r = $gestor->set($usuario, $correo);
       break;
   }else{
       echo 'Este email no esta registrado';
   }
       
}

header("Location:../usuario/confirmacion.php?op=activado");