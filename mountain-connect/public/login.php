<?php
    include "../includes/header.php";
?>
<?php
    $errores = [];
    $usuarios = $_SESSION['usuarios']??[]; //para guardar 
    if($_SERVER["REQUEST_METHOD"]=== 'POST'){
        $usuario = $_POST['usuario_email'] ?? '';
        $passwd = $_POST['password'] ?? '';
        if(empty($usuario) || empty($passwd)){
            $errores[] = "Hay campos vacíos.";
        }
        if(empty($errores)){
            if (!empty($_SESSION['usuarios'])) {
                $users=$_SESSION['usuarios'];//insertar el contenido de la sesión en el array
                $exist=false; //variable que es true si el usuario o email introducido existe.
                foreach($users as $u){
                    if($u['username'] == $usuario || $u['email'] == $usuario ){
                        $exist=true;
                        if($u['password']==$passwd){
                            #$_SESSION['username']=$u['username']; /*guarda la sesión*/
                            #$_SESSION['']=$u['']
                            $_SESSION['usuario']=$u;
                            Header("Location: index.php");
                            exit();
                        }else{
                            $errores[]="La contraseña es incorrecta.";
                            break;
                        }
                    }
                }
                if(!$exist){
                    $errores[]="El usuario o email no existe.";/*Comprueba si el usuario existe, al finalizar el foreach para que el array 
                    $errores no se llene con varias instancias de "El usuario o email no existe." incluso estando correcto.*/
                }
            }
        }
    }
    $mensaje = "";
    $tipo_mensaje = "";
    if(!empty($errores)){
        $mensaje=implode('<br>', $errores);
        $tipo_mensaje="error";
    }
?>
<!--head-->
       <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar Sesión - MountainConnect</title>
        <link rel="stylesheet" href="../assets/css/login.css"> 
    <!--body-->
    <main>
        <div class="login-card">
    <h2>Iniciar Sesión</h2>
        <?php
            if(isset($mensaje)){
                echo '<div class="mensaje-'.$tipo_mensaje.'">';
                echo $mensaje;
                echo '</div>';
            }
        ?>
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
    </main>
<?php
    include "../includes/footer.php";
?>