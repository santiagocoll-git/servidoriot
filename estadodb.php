<?php
require_once('conexion.php');


class estadodb
{

    public function verEstadoDb()
    {
        $conn = new conexion();
        /* comprobar si el servidor sigue funcionando */
        if (mysqli_ping($conn->conectardb())) {
            printf("¡La conexión está bien!\n");
        } else {
            printf("Error: %s\n", mysqli_error($conn->conectardb()));
        }
    }
    
}
?>