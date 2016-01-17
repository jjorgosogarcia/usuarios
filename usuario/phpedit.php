<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageUser($bd);
$usuarios = $gestor->getList();
$newPassword = Request::post("clave");
$correo = Request::post("pkID");
$usuario = $gestor->get($correo);
$usuarios2 = new User();
$usuarios2->read();
$enviarMail = new SendGoogleMail();
$titulo = 'Activacion de la cuenta';
$nuevoCorreo = Request::post('email');

echo "el correo es: ".$correo . "y el nuevo correo es " .$nuevoCorreo;
$activacion = sha1($nuevoCorreo . Constant::SEMILLA);
foreach ($usuarios as $indice => $usuario) { 
    echo "el correo es: ".$correo . "y el nuevo correo es " .$nuevoCorreo. "y el original es " .$usuario->getEmail();
   if($correo == $usuario->getEmail() && $nuevoCorreo != $usuario->getEmail()){
        echo '<br><br>Perfecto<br><br>' ;
         $usuarios2->setActivo(0);
        $r = $gestor->set($usuarios2, $correo);
        $enviarMail->sendActivationMail2($nuevoCorreo, $titulo, "$titulo  https://gestorusuarios-jjorgosogarcia.c9users.io/controlUsuario/phpActivarCorreo.php?correo=$nuevoCorreo&activacion=$activacion");
       // header("Location:../usuario/confirmacion.php?op=mail");
    }else{
        echo "<br><br>No perfecto";
        $usuarios2->setActivo(1);
    }
    
}

/*Subir fotografia*/
$subir= new FileUpload("nuevaImagen");
$subir->setDestino("../controlUsuario/avatares/");
$subir->setTamaño(100000000);
$subir->setNombre($correo);
$subir->setPolitica(FileUpload::REEMPLAZAR);
if($subir->upload()){
    echo 'Archivo subido con éxito';
} else{
    echo 'Archivo no subido';
}

$usuarios2->setImagen($correo.".".$subir->getExtension());

        
$pkID = Request::post("pkID");
$r = $gestor->set($usuarios2, $pkID);

$bd->close();
//echo $r;
//var_dump($bd->getError());

//header("Location:../acceso/indexBaja.php?op=edit&r=$r");



