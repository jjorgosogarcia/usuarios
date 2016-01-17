<?php
session_start();
require_once 'clases/googleMail/Google/autoload.php';
$cliente = new Google_Client();
$cliente->setApplicationName('LecturaDeCorreosProyectoEnviarCorreoDesdeGmail');
$cliente->setClientId('881528425250-u5adg3g0dln4vgv9m93ekq066sp1q3ba.apps.googleusercontent.com');
$cliente->setClientSecret('lN-IYExbR3EFhnso-BoaEN9F');
$cliente->setRedirectUri('https://gestorusuarios-jjorgosogarcia.c9users.io/guardar.php');
$cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
$cliente->setAccessType('offline');
if (isset($_GET['code'])) {
   $cliente->authenticate($_GET['code']);
   $_SESSION['token'] = $cliente->getAccessToken();
   $archivo = "clases/googleMail/token.conf";
   $fh = fopen($archivo, 'w') or die("error");
   fwrite($fh, $cliente->getAccessToken()); //almacenamiento del token
   fclose($fh);
}

header("Location:login/login.php");