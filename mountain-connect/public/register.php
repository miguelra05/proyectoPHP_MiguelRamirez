<?php
include "../includes/header.php";
?>
<?php
$errores = [];
$usuarios = [];
$usuarios = $_SESSION['usuarios'] ?? []; //Comprueba si el array usuarios existe y si no, inicializa uno vacío, sinó anida otro al array.
// colección de los datos introducidos en el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confPass = $_POST['confirm_password'];
    $explvl = $_POST['nivel_experiencia'];
    $especialidad = $_POST['especialidad'];
    $prov = $_POST['provincia'];
    // validación de errores (usuario vacío, email no valido, longitud de contraseña, etc)
    if (empty($user)) {
        $errores[] = "El usuario es obligatorio.";
    }
    if (empty($email)) {
        $errores[] = "El email no puede estar vacío.";
    }
    if (strlen($email) > 0 && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = " Formato de email no válido.";
    }
    //comprobar longitud de contraseña
    if (strlen($pass) < 8) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres.";
    }
    // comprobar si la contraseña contiene números y caracteres
    if (!preg_match('/\d/', $pass)) {//comprueba números
        $errores[] = "La contraseña debe contener al menos un número.";
    }
    if (!preg_match('/[a-zA-Z]/', $pass)) {//comprueba letras
        $errores[] = "La contraseña debe contener al menos una letra.";
    }
    if ($pass !== $confPass) {
        $errores[] = "Las contraseñas no coinciden.";
    }
    if (empty($explvl)) {
        $errores[] = "Debes seleccionar tu nivel de experiencia.";
    }
    if (!empty($especialidad)) {
        // comprobación de caracteres válidos.
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s-]+$/", $especialidad)) {
            $errores[] = "La especialidad solo puede contener letras, espacios y guiones.";
        }
        // comprobación de longitud máxima.
        if (strlen($especialidad) > 100) {
            $errores[] = "La especialidad no debe exceder los 100 caracteres.";
        }
    }
    if (empty($prov)) {
        $errores[] = "Selecciona una provincia";
    }
    if (empty($errores)) {
        $nuevoUsuario = [
            "username" => $user,
            "email" => $email,
            "password" => $pass,
            "experiencia" => $explvl,
            "especialidad" => $especialidad,
            "provincia" => $prov
        ];
        $usuarios[] = $nuevoUsuario;// mete el "nuevo usuario" en el array usuarios
        $_SESSION['usuarios'] = $usuarios;
        $mensaje = "Te has registrado con éxito";
        $tipo_mensaje = "exito";
        Header("Location: login.php");
        exit();
    } else {
        #foreach($errores as $error){
        $mensaje = implode("<br>", $errores);
        $tipo_mensaje = "error";
        #}
    }
}

?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrarse - MountainConnect</title>
<link rel="stylesheet" href="../assets/css/register.css">
<!--body-->
<main>
    <div class="register-card">
        <h2>Crear Cuenta</h2>
        <?php
        if (isset($mensaje)) {
            echo '<div class="mensaje-' . $tipo_mensaje . '">';
            echo $mensaje;
            echo "</div>";
        }
        ?>
        <form action="register.php" method="POST">

            <div class="form-group">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="form-group">
                <label for="nivel_experiencia">Nivel de Experiencia:</label>
                <select class="form-control" id="nivel_experiencia" name="nivel_experiencia" required>
                    <option value="" disabled selected>Selecciona tu nivel</option>
                    <option value="principiante">Principiante</option>
                    <option value="intermedio">Intermedio</option>
                    <option value="avanzado">Avanzado</option>
                    <option value="experto">Experto</option>
                </select>
            </div>

            <div class="form-group">
                <label for="especialidad">Especialidad (Ej: Senderismo, Escalada, Vía Ferrata):</label>
                <input type="text" class="form-control" id="especialidad" name="especialidad">
            </div>

            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <select class="form-control" id="provincia" name="provincia" required>
                    <option value="" disabled selected>Selecciona tu provincia</option>
                    <option value="barcelona">Barcelona</option>
                    <option value="madrid">Madrid</option>
                    <option value="zaragoza">Zaragoza</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Registrarme</button>
        </form>

        <div class="login-link">
            ¿Ya tienes cuenta? <a href="login.php">Iniciar Sesión</a>
        </div>
    </div>
</main>
<?php
include "../includes/footer.php";
?>