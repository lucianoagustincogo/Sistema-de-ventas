<?php 
// Iniciamos las sesiones
session_start();
// Destruimos las sesiones
session_destroy();
// Llevamos a login.php
header("Location: login.php");
exit();
?>