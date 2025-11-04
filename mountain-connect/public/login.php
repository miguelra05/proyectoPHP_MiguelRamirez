<?php
?>
<!DOCTYPE html>
<html>
    <head>
       <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar Sesión - MountainConnect</title>
        <link rel="stylesheet" href="../assets/css/style.css"> 
    </head>
    <body>
        <div class="login-card">
    <h2>Iniciar Sesión</h2>

    <form action="login.php" method="POST">
        
        <div class="form-group">
            <label for="usuario_email">Usuario o Email:</label>
            <input type="text" 
                   class="form-control" 
                   id="usuario_email" 
                   name="usuario_email" 
                   required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" 
                   class="form-control" 
                   id="password" 
                   name="password" 
                   required>
        </div>

        <button type="submit" class="btn-submit">Entrar</button>
    </form>

        <div class="registro-link">
            ¿Aún no tienes cuenta? <a href="register.php">Regístrate aquí</a>
        </div>
    </div>
    </body>
</html>