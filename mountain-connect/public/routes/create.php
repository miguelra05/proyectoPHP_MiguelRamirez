<?php
    include "../../includes/header.php";
?>
<?php
    if(!isset($_SESSION['usuario'])){
        Header("Location: ../login.php"); //Vuelve al login si no hay sessión activa
        exit();
    }
$errores = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomRuta = $_POST['title'];
    $desc = $_POST['description'];
    $difRuta = $_POST['difficulty'];
    $distancia = $_POST['distance'];
    $desnivel = $_POST['elevation_gain'];
    $nvlTec = $_POST['technical_level'];
    $nvlFis = $_POST['fitness_level'];
    $fotos = $_FILES['photos'];

    $nomFotos = [];

    if (empty($nomRuta)) {
        $errores[] = "Ponle un nombre a la ruta.";
    }
    if (empty($desc)) {
        $errores[] = "Describe la ruta.";
    }
    if (empty($difRuta)) {
        $errores[] = "Elige una dificultad.";
    }
    if (empty($distancia)) {
        $errores[] = "Por favor elige una distancia.";
    }
    if (!is_numeric($distancia)) {
        $errores[] = "El valor de la distancia debe ser un número.";
    }
    if (empty($desnivel)) {
        $errores[] = "Indica el desnivel que tiene la ruta.";
    }
    if (!is_numeric($desnivel)) {
        $errores[] = "El valor del desnivel debe ser numérico.";
    }
    if (empty($nvlTec)) {
        $errores[] = "Introduce un nivel tecnico.";
    }
    if (empty($nvlFis)) {
        $errores[] = "Introduce un nivel físico.";
    }
    if (empty($fotos['name'][0])) {
        $errores[] = "Sube al menos una foto.";
    } else {
        $numArchivos = count($fotos['name']);
        if ($numArchivos > 5) {
            $errores[] = "Máximo 5 fotos permitidas.";
        }
        for ($i = 0; $i < $numArchivos; $i++) {
            $nombreArchivo = $fotos['name'][$i];
            $tipoArchivo = $fotos['type'][$i];
            $tamañoArchivo = $fotos['size'][$i];
            $errorArchivo = $fotos['error'][$i];

            // Verificar que no haya errores en la subida
            if ($errorArchivo !== UPLOAD_ERR_OK) {
                $errores[] = "Error al subir el archivo: $nombreArchivo";
                continue;
            }

            // Validar tipo de archivo
            $extensionesPermitidas = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!in_array($tipoArchivo, $extensionesPermitidas)) {
                $errores[] = "El archivo $nombreArchivo no es una imagen válida (solo JPG/PNG)";
            }

            // Validar tamaño
            if ($tamañoArchivo > 2 * 1024 * 1024) {
                $errores[] = "El archivo $nombreArchivo es demasiado grande (máx. 2MB)";
            }

            $exetension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);// Extraemos la extensión
            $nomUnico = uniqid() . '_' . time() . '.' . $exetension; //Creamos un nombre de archivo unico con uniqid que da un id unico, la hora y por ultimo la extensión
            $ruta = __DIR__ . '/../photos/' . $nomUnico; //la ruta donde se guardará el archivo (con el nombre del archivo)
            $rutaOrigi = __DIR__ . '/../photos/'; //el nombre del directorio donde guardaremos las fotos

            if (!is_dir($rutaOrigi)) {
                mkdir($rutaOrigi, 0755, true); // En caso de que no esté creado el directorio, lo crea.
            }

            if (move_uploaded_file($fotos['tmp_name'][$i], $ruta)) {
                $nomFotos[] = $nomUnico; // Mueve las fotos a la ruta elegida.
            } else {
                $errores[] = "error"; // en caso de fallar da error
            }
        }
        

    }
    if (empty($errores)) {
            //crear un array con todos los campos de la ruta en caso de que no haya habido errores
            $nuevaRuta = [
                "nombre" => $nomRuta,
                "descripcion" => $desc,
                "dificultad" => $difRuta,
                "distancia" => $distancia,
                "desnivel" => $desnivel,
                "nivel_tecnico" => $nvlTec,
                "nivel_fisico" => $nvlFis,
                "imagen" => $nomFotos
            ];
            // $rutas[] = $nuevaRuta;
            if (!isset($_SESSION['rutas'])) {
                $_SESSION['rutas'] = []; //si no hay un array en sessión para las rutas, lo inicializa
            }
            $_SESSION['rutas'][] = $nuevaRuta;
            header('Location: list.php');
            exit();
        } else {
            // si hay errores los muestra por pantalla.
            $mensaje = implode("<br>", $errores);
            $tipo_mensaje = "error";
        }
}
?>
<meta charset="UTF-8">
<link rel="stylesheet" href="../../assets/css/create.css">
<main class="form-container">
    <h2>Crear Nueva Ruta</h2>
    <p>Comparte tu próxima aventura en MountainConnect rellenando los detalles técnicos y subiendo las mejores fotos.
    </p>

    <form action="create.php" method="POST" enctype="multipart/form-data" class="route-form">

        <fieldset>
            <legend>Detalles de la Ruta</legend>

            <div class="form-group">
                <label for="title">Título de la Ruta *</label>
                <input type="text" id="title" name="title" required maxlength="100">
            </div>

            <div class="form-group">
                <label for="description">Descripción *</label>
                <textarea id="description" name="description" required rows="6"></textarea>
            </div>

            <div class="form-group">
                <label for="difficulty">Dificultad *</label>
                <select id="difficulty" name="difficulty" required>
                    <option value="">-- Selecciona Nivel --</option>
                    <option value="1">Fácil</option>
                    <option value="2">Media</option>
                    <option value="3">Difícil</option>
                    <option value="4">Experto</option>
                </select>
            </div>
        </fieldset>

        <fieldset>
            <legend>Datos Técnicos</legend>

            <div class="half-width">
                <div class="form-group">
                    <label for="distance">Distancia (km) *</label>
                    <input type="number" id="distance" name="distance" required step="0.1" min="0">
                </div>

                <div class="form-group">
                    <label for="elevation_gain">Desnivel Positivo (m) *</label>
                    <input type="number" id="elevation_gain" name="elevation_gain" required min="0">
                </div>
            </div>
            <div class="levels-group">
                <div class="level-item">
                    <label for="technical_level">Nivel Técnico *</label>
                    <select id="technical_level" name="technical_level" required>
                        <option value="">-- Selecciona --</option>
                        <option value="1">1 - Muy Bajo</option>
                        <option value="2">2 - Bajo</option>
                        <option value="3">3 - Medio</option>
                        <option value="4">4 - Alto</option>
                        <option value="5">5 - Muy Alto</option>
                    </select>
                </div>

                <div class="level-item">
                    <label for="fitness_level">Nivel Físico *</label>
                    <select id="fitness_level" name="fitness_level" required>
                        <option value="">-- Selecciona --</option>
                        <option value="1">1 - Muy Bajo</option>
                        <option value="2">2 - Bajo</option>
                        <option value="3">3 - Medio</option>
                        <option value="4">4 - Alto</option>
                        <option value="5">5 - Muy Alto</option>
                    </select>
                </div>
            </div>

            <div class="checkbox-group">
                <label>Época del Año Recomendada *</label>
                <div class="checkbox-options">
                    <div class="checkbox-option">
                        <input type="checkbox" id="season_spring" name="season[]" value="primavera">
                        <label for="season_spring">Primavera</label>
                    </div>
                    <div class="checkbox-option">
                        <input type="checkbox" id="season_summer" name="season[]" value="verano">
                        <label for="season_summer">Verano</label>
                    </div>
                    <div class="checkbox-option">
                        <input type="checkbox" id="season_autumn" name="season[]" value="otono">
                        <label for="season_autumn">Otoño</label>
                    </div>
                    <div class="checkbox-option">
                        <input type="checkbox" id="season_winter" name="season[]" value="invierno">
                        <label for="season_winter">Invierno</label>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>*Subida de Fotos (Máx. 5)</legend>
            <p class="file-info">Sube hasta 5 fotos (JPG/PNG). La primera será la miniatura de la ruta.</p>
            <div class="form-group">
                <label for="photos">Seleccionar Archivos</label>
                <input type="file" id="photos" name="photos[]" multiple accept=".jpg,.jpeg,.png">
            </div>
        </fieldset>

        <button type="submit" name="submit_route" class="btn-primary">Crear Ruta</button>
    </form>
</main>

<?php
include "../../includes/footer.php";
?>