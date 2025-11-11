<?php
    session_start();
    unset($_SESSION['usuario']);//desselecciona el usuario iniciado.
    Header("Location: index.php");
?>