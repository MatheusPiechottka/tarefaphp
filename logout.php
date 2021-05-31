<?php
session_start();

include'conectar.php';

date_default_timezone_set('America/Sao_Paulo');
$time = date( 'Y-m-d H:i:s' );

#Log
$sql = "INSERT INTO log (fk_logtipo, tempolog, fk_idusuario) values ('2', '$time' ,'{$_SESSION['id']}')";
$result = $con->query($sql);

unset($_SESSION['id']);

header('location:login.php');
?>