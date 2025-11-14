<?php
    $base_path = '';
    if (strpos($_SERVER['PHP_SELF'], '/routes/') !== false) {
        $base_path = '../';
    } else if (strpos($_SERVER['PHP_SELF'], '/public/') !== false) {
        $base_path = '';
    }
?>
<meta charset="UTF-8">
<link rel="stylesheet" href="<?php echo $base_path; ?>../assets/css/footer.css">
    <footer>
        <div class="footer-container">

            <div class="footer-section logo-section">
                <h4 class="footer-logo">MountainConnect</h4>
                <p>Conecta con la montaña, encuentra tu próxima ruta y vive la aventura.</p>
            </div>

            <div class="footer-section quick-links">
                <h4>Enlaces Rápidos</h4>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="rutas.php">Explorar Rutas</a></li>
                    <li><a href="profile.php">Mi Perfil</a></li>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                </ul>
            </div>

            <div class="footer-section legal-info">
                <h4>Información Legal</h4>
                <ul>
                    <li><a href="contacto.php">Contacto</a></li>
                    <li><a href="privacidad.php">Política de Privacidad</a></li>
                    <li><a href="terminos.php">Términos y Condiciones</a></li>
                </ul>
            </div>

            <div class="footer-section social-media">
                <h4>Síguenos</h4>
                <div class="social-icons">
                    <a href="#" target="_blank" class="social-icon facebook">Facebook</a>
                    <a href="#" target="_blank" class="social-icon instagram">Instagram</a>
                    <a href="#" target="_blank" class="social-icon twitter">Twitter</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 MountainConnect. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>