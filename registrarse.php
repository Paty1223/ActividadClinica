<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Usuario</title>
</head>

<body>
    <div class="container"><br>
        <div class="row justify-content-center">
            <div class="col-6 p-5 bg-white shadow-lg rounded">
                <?php
                    include('config.php');
                    session_start();
                    if (isset($_POST['registro'])) {

                        $username = $_POST['usuario'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $password_hash = password_hash($password, PASSWORD_BCRYPT);
                        $query = $conn->prepare("SELECT * FROM usuario WHERE email=:email");
                        $query->bindParam("email", $email, PDO::PARAM_STR);
                        $query->execute();

                        if ($query->rowCount() > 0) {
                            echo '<div class="alert alert-danger" role="alert">¡La dirección de correo electrónico ya está registrada!</div>';
                        }

                        if ($query->rowCount() == 0) {
                            $query = $conn->prepare("INSERT INTO usuario(usuario,password,email) VALUES (:username,:password_hash,:email)");
                            $query->bindParam("username", $username, PDO::PARAM_STR);
                            $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
                            $query->bindParam("email", $email, PDO::PARAM_STR);
                            $result = $query->execute();

                            if ($result) {
                                echo '<div class="alert alert-success" role="alert">Usuario Agregado!</div>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">Error!</div>';
                            }
                        }
                    }
                ?>
                <h3>Usuario</h3>
                <hr>
                <form method="post">
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input id="usuario" class="form-control" type="text" name="usuario">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input id="password" class="form-control" type="password" name="password">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input id="email" class="form-control" type="email" name="email">
                    </div>

                    <br>

                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary" name="registro" type="submit">Agregar</button>
                        <a class="btn btn-info" href="index.php" type="submit">Cancelar</a>
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