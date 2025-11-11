<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>
    <header>
        <div class="header-container">

            <div class="logo">
                <a href="index.php">
                    MountainConnect
                </a>
            </div>

            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="rutas.php">Rutas</a></li>
                </ul>
            </nav>

            <div class="user-actions">
                <?php
                // Comprobamos si el usuario está logueado
                if (isset($_SESSION['usuario'])) {
                    // El usuario está logueado
                    $username = htmlspecialchars($_SESSION['usuario']['username']);
                    
                    echo '<a href="profile.php" class="btn-profile">🧗 (' . $username . ')</a>';
                    echo '<a href="logout.php" class="btn-logout">Cerrar Sesión</a>';
                    
                } else {
                    // El usuario NO está logueado
                    echo '<a href="login.php" class="btn-login">Iniciar Sesión</a>';
                    echo '<a href="register.php" class="btn-register">Regístrate</a>';
                }
            ?>
            </div>

        </div>
    </header>