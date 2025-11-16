<?php
    include "../includes/header.php";
?>
<?php
    if(!isset($_SESSION['usuario'])){
        Header("Location: login.php"); //Vuelve al login si no hay sessión activa
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<!--head-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
<!--body-->
<main>
    <div class="profile-card">
        <?php
            echo "<h2> ".$_SESSION['usuario']['username']."</h2>";
            echo "<img src='../assets/images/pfp.png' alt='Pefil' width='150' height='150'>";
            echo "<a href='./logout.php'>Cerrar sesión</a>";
            echo "<p>Usuario: ".$_SESSION['usuario']['username']."</p>";
            echo "<p>Email: <a href='mailto:".$_SESSION['usuario']['email']."'>".$_SESSION['usuario']['email']."</a>";

        ?>
    </div>
</main>
<?php
    include "../includes/footer.php";
?>