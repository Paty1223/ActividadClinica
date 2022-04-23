<?php
session_start();
include ('config.php');

if(isset($_POST['modificar']))
{
    $id = $_GET['modificarid'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $numhistorial = $_POST['numhistorial'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    if($llamado -> Actualizar($id, $nombre, $apellido, $numhistorial, $telefono, $direccion))
    {
        $mensaje = "<div class='alert alert-success' role='alert'>Registro se modofico!</div>";
    }
    else
    {
        $mensaje = "<div class='alert alert-danger' role='alert'>No se logro modificar!</div>";
    }
}

if (isset($_GET['modificarid']))
{
    $id = $_GET['modificarid'];
    $sql = $conn -> prepare("SELECT * FROM pacientes WHERE idpaciente = ?");
    $sql->execute([$id]);
    $dato = $sql -> fetch(PDO::FETCH_OBJ);
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
    <title>Pacientes</title>
</head>

<body>
    <div class="container"><br>
        <div class="row justify-content-center">
            <div class="col-6 p-5 bg-white shadow-lg rounded">
                <?php
                    if(isset($mensaje))
                    {
                        echo $mensaje;
                    }
                ?>
                <h3>Nuevo Paciente</h3>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input id="nombre" value="<?php echo $dato->nombre;?>" class="form-control" type="text"
                            name="nombre">
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input id="apellido" value="<?php echo $dato->apellido;?>" class="form-control" type="text"
                            name="apellido">
                    </div>

                    <div class="form-group">
                        <label for="numhistorial">Numero Historial:</label>
                        <input id="numhistorial" value="<?php echo $dato->numhistorial;?>" class="form-control"
                            type="text" name="numhistorial">
                    </div>

                    <div class="form-group">
                        <label for="telefono">Telefono:</label>
                        <input id="telefono" value="<?php echo $dato->telefono;?>" class="form-control" type="text"
                            name="telefono">
                    </div>

                    <div class="form-group">
                        <label for="direccion">Direccion:</label>
                        <input id="direccion" value="<?php echo $dato->direccion;?>" class="form-control" type="text"
                            name="direccion">
                    </div>

                    <br>

                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary" name="modificar" type="submit">Modificar</button>
                        <a class="btn btn-info" href="mostrar.php" type="submit">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>