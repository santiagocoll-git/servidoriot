<?php
require_once ('conexion.php');
$conexion = conectardb();
global $conexion;
//consulta para extraer datos device_state
$device_state = "SELECT idDevice FROM device_state";
$guardar = mysqli_query($conexion,$device_state);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de BD</title>
</head>
<body>
    <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h4 class="text-center">Registro con PHP y MySQL</h4>
            <select class="form-control" name="idDeviceFind" id="">
                <option value="">Seleciona un Dispositivo</option>
                <$php while($row = $guardar->fetch_assoc())}?>
                <option value="<?php echo $row['idDevice']"><?php echo $row['idDevice']"></option>
                ?>
            </select>
        </div>
    </div>
</body>
</html>