<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php require_once "menu.php"; ?>
    <title>Agregar Paciente</title>
</head>

<body>
    <div class="container"><br>
        <div class="row justify-content-center">
            <div class="col-6 p-5 bg-white shadow-lg rounded">
                <?php
                    if (isset($_POST['agregarpaciente'])) {
                        $nombre = $_POST['nombre'];
                        $apellido = $_POST['apellido'];
                        $historial = $_POST['historial'];
                        $telefono = $_POST['telefono'];
                        $direccion = $_POST['direccion'];

                        $query = $conn->prepare("INSERT INTO pacientes (nombre, apellido, numhistorial, telefono, direccion) 
                        VALUES (:nombre, :apellido, :numhistorial, :telefono, :direccion)");
                        $query->bindParam("nombre", $nombre, PDO::PARAM_STR);
                        $query->bindParam("apellido", $apellido, PDO::PARAM_STR);
                        $query->bindParam("numhistorial", $historial, PDO::PARAM_STR);
                        $query->bindParam("telefono", $telefono, PDO::PARAM_STR);
                        $query->bindParam("direccion", $direccion, PDO::PARAM_STR);
                        $result = $query->execute();

                        if ($result) 
                        {
                            echo '<div class="alert alert-success" role="alert">Tu registro fue exitoso!</div>';
                        } 
                        else 
                        {
                            echo '<div class="alert alert-danger" role="alert">??Algo sali?? mal!</div>';
                        }
                    }
                ?>
                <h3>Nuevo Paciente</h3>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input id="nombre" class="form-control" type="text" name="nombre">
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input id="apellido" class="form-control" type="text" name="apellido">
                    </div>

                    <div class="form-group">
                        <label for="historial">Numero Historial:</label>
                        <input id="historial" class="form-control" type="text" name="historial">
                    </div>

                    <div class="form-group">
                        <label for="telefono">Telefono:</label>
                        <input id="telefono" class="form-control" type="text" name="telefono">
                    </div>

                    <div class="form-group">
                        <label for="direccion">Direccion:</label>
                        <input id="direccion" class="form-control" type="text" name="direccion">
                    </div>

                    <br>
                    <button class="btn btn-primary" name="agregarpaciente" type="submit">Agregar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>