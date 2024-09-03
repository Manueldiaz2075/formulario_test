<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    // Crear un array asociativo con los datos
    $datos = array(
        "nombre" => $nombre,
        "email" => $email
    );

    // Definir la ruta del archivo JSON
    $archivo = 'datos.json';

    // leer los datos del archivo (si existe)
    if(file_exists($archivo)){
        $contenido_actual = file_get_contents($archivo);
        $datos_existentes = json_decode($contenido_actual, true);
    

        // si el JSON no está vacio, añadir los nuevos datos al array existente
        if($datos_existentes !== null) {
            $datos_existentes[] = $datos;
        }else{
            // Si el archivo está vacio, empezar con un array nuevo
            $datos_existentes = array($datos);
        }
    
    }else{
        //Si el archivo no existe, crear un nuevo array con los datos
        $datos_existentes = array($datos);
    }

    //Codificar el array a formato JSON
    $json_data = json_encode($datos_existentes, JSON_PRETTY_PRINT);

    //Escribir los datos codificados
    if(file_put_contents($archivo, $json_data)) {
        echo 'Datos guardados correctamente';
    }else{
        echo 'Error al guardar los datos';
    }
}
