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
            if(isset($_SESSION['usuario']['username'])){
                echo $_SESSION['usuario']['username'];
            }?>
    a Mountain Connect!</h1>
        </main>
<?php
    include "../includes/footer.php";
?>