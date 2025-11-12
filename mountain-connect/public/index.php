<?php
include "../includes/header.php";
?>
<?php
$loggedIn = isset($_SESSION['username']);

?>
<!--head-->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Página principal</title>
<link rel="stylesheet" href="../assets/css/index.css">
<!--body-->
<main>
    <h1>Bienvenido
        <?php
        if (isset($_SESSION['usuario']['username'])) {
            echo $_SESSION['usuario']['username'];
        } ?>
        a Mountain Connect!
    </h1>
    <div class="main-content-wrapper">

        <?php if (isset($_SESSION['usuario'])):
            ?>

            <section class="user-dashboard">
                <h1>Bienvenido de Nuevo, <?php echo $_SESSION['usuario']['username']; ?></h1>
                <p>¡Explora o comparte tu próxima aventura en la montaña!</p>

                <div class="dashboard-menu">
                    <h3>Acciones Rápidas</h3>
                    <nav class="dashboard-nav">
                        <ul>
                            <li><a href="profile.php" class="dash-link profile-link">Mi Perfil y Actividad</a></li>
                            <li><a href="routes/create.php" class="dash-link create-link">Crear Nueva Ruta</a></li>
                            <li><a href="routes/list.php" class="dash-link explore-link">Explorar Rutas de Senderismo</a>
                            </li>
                            <li><a href="ferratas/list.php" class="dash-link explore-link">Explorar Vías Ferratas</a></li>
                            <li><a href="climbing/list.php" class="dash-link explore-link">Explorar Vías de Escalada</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </section>

        <?php else: ?>

            <section class="welcome-guest">
                <h1>MountainConnect: Conecta y Explora la Montaña</h1>
                <p>Únete a la comunidad de montañeros para compartir y descubrir rutas, vías ferratas y de escalada en tu
                    provincia.</p>

                <div class="guest-actions">
                    <a href="login.php" class="btn-cta primary-cta">Iniciar Sesión</a>
                    <a href="register.php" class="btn-cta secondary-cta">¡Regístrate Ahora!</a>
                </div>
                <p class="guest-pitch">La plataforma social destinada a la comunidad montañera.</p>
            </section>

        <?php endif; ?>
    </div>
    
    <section class="site-info">
        <h2>MountainConnect: Tus Aventuras, Organizadas.</h2>
        <div class="info-grid">
            <div class="info-item">
                <i class="icon-hiking"></i> <h3>Rutas de Senderismo</h3>
                <p>Descubre miles de rutas de senderismo creadas por la comunidad, con datos técnicos, dificultad y seguimiento GPS.</p>
            </div>
            <div class="info-item">
                <i class="icon-ferrata"></i> <h3>Vías Ferratas</h3>
                <p>Explora información detallada sobre vías ferratas cercanas, requisitos de equipo y valoraciones de seguridad.</p>
            </div>
            <div class="info-item">
                <i class="icon-climbing"></i> <h3>Vías de Escalada</h3>
                <p>Encuentra vías de escalada por provincia, tipo de roca y grado. Comparte tus ascensos y fotografías.</p>
            </div>
        </div>
    </section>
</main>
<?php
include "../includes/footer.php";
?>