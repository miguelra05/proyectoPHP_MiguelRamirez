<?php
    include "../../includes/header.php";
    if(!isset($_SESSION['usuario'])){
        Header("Location: ../login.php"); //Vuelve al login si no hay sessión activa
        exit();
    }
    $rutas = $_SESSION['rutas'] ?? [];
?>
<meta charset="UTF-8">
<link rel="stylesheet" href="../../assets/css/list.css">

<main class="content-wrapper-min">
    <h1 class="mb-4">⛰️ Explorar Rutas</h1>
    
    <?php if (empty($rutas)): ?>
        <div class="alert alert-info" role="alert">
            Aún no hay rutas registradas. ¡<a href="create.php" class="alert-link">Crea la primera aquí</a>!
        </div>
    <?php else: ?>
        
        <div class="route-grid">
        
        <?php foreach ($rutas as $index => $ruta): ?>
            
            <div class="route-col">
                <div class="route-card">
                    
                    <?php if (!empty($ruta['imagen']) && is_array($ruta['imagen'])): 
                        $ruta_foto = "../photos/" . htmlspecialchars($ruta['imagen'][0]);
                    ?>
                        <img src="<?php echo $ruta_foto; ?>" 
                             class="route-thumbnail" 
                             alt="Foto de la ruta <?php echo htmlspecialchars($ruta['nombre']); ?>">
                    <?php else: ?>
                        <div class="route-thumbnail placeholder-img">
                            </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($ruta['nombre']); ?></h5>
                        
                        <ul class="list-unstyled small mt-3">
                    <!-- el php dentro de las etiquetas pone cada valor en su campo-->
                            <li><?php echo htmlspecialchars($ruta['descripcion']); ?></li>
                            <li>En: <?php echo htmlspecialchars($ruta['provincia']); ?></li>
                            <li>Distancia: <?php echo htmlspecialchars($ruta['distancia']); ?> km</li>
                            <li>Desnivel: <?php echo htmlspecialchars($ruta['desnivel']); ?> m</li>
                            <li>Duración: <?php echo htmlspecialchars($ruta['duracion']); ?> h</li>
                            <li>Dificultad: <?php echo htmlspecialchars($ruta['dificultad']); ?></li>
                        </ul>
                    </div>
                    
                    <div class="card-footer">
                        <a href="view.php?id=<?php echo $index; ?>" class="btn-outline-success">
                            Ver Detalle
                        </a>
                    </div>
                </div>
            </div>
            
        <?php endforeach; ?>
        
        </div> <?php endif; ?>
</main>
<?php
    include "../../includes/footer.php";
?>