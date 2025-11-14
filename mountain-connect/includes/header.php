<?php 
    session_start();

    $base_path = '';
    if (strpos($_SERVER['PHP_SELF'], '/routes/') !== false) {
        $base_path = '../';
    } else if (strpos($_SERVER['PHP_SELF'], '/public/') !== false) {
        $base_path = '';
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo $base_path;?>../assets/css/header.css">
</head>

<body>
    <header>
        <div class="header-container">

            <div class="logo">
                <a <?php
                        if($base_path === '../'){
                            echo 'href="'.$base_path.'index.php">';
                        }else{
                            echo 'href="index.php">';
                        }
                        ?>
                    MountainConnect
                </a>
            </div>

            <nav class="main-nav">
                <ul>
                    <li>
                        <?php
                        if($base_path === '../'){
                            echo '<a href="../index.php">Inicio</a>';
                        }else{
                            echo '<a href="index.php">Inicio</a>';
                        }
                        ?>
                    </li>
                    <li>
                        <?php
                        if($base_path === '../'){
                            echo '<a href="list.php">Ver Rutas</a>';
                        }else{
                            echo '<a href="routes/list.php">Ver Rutas</a>';
                        }
                        ?>
                    </li>
                    <li>
                        <?php
                        if($base_path === '../'){
                            echo '<a href="create.php">Crear Ruta</a>';
                        }else{
                            echo '<a href="routes/create.php">Crear ruta</a>';
                        }
                        ?>
                    </li>
                </ul>
            </nav>

            <div class="user-actions">
                <?php
                // Comprobamos si el usuario está logueado
                if (isset($_SESSION['usuario'])) {
                    // El usuario está logueado
                    $username = htmlspecialchars($_SESSION['usuario']['username']);
                    echo '<a href="'.$base_path.'create.php" class="btn-crear">Crear Ruta</a>';
                    echo '<a href="'.$base_path.'profile.php" class="btn-profile">🧗 (' . $username . ')</a>';
                    echo '<a href="'.$base_path.'logout.php" class="btn-logout">Cerrar Sesión</a>';
                } else {
                    // El usuario NO está logueado
                    echo '<a href="'.$base_path.'login.php" class="btn-login">Iniciar Sesión</a>';
                    echo '<a href="'.$base_path.'register.php" class="btn-register">Regístrate</a>';
                }
                ?>
            </div>

        </div>
    </header>