    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    


<?php
 require_once ('conexion.php');

 $device = $_POST['device_label'];
 $temperature = $_POST['temperature'];
 $humidity = $_POST['humidity'];

$conn = new conexion();

 $query = " UPDATE device_state SET temperatura = $temperature, humedad = $humidity WHERE iddevice = '$device'";
 $update = mysqli_query($conn->conectardb(),$query);

 $query = "INSERT INTO device_historic(idDevice, variable, valor, fecha) VALUES ('$device', 'temperature','$temperature', NOW())";
 $insert = mysqli_query($conn->conectardb(),$query);

 $query = "INSERT INTO device_historic(idDevice,variable, valor, fecha) VALUES('$device', 'humidity','$humidity', NOW())";
 $insert = mysqli_query($conn->conectardb(),$query);

echo "<div class='alert alert-success' role='alert'>
Datos Recibidos!<br>
Device = $device<br>
Temperature = $temperature<br>
Humidity = $humidity<br>

</div>";
?>
