<?php
class Pacientes
{
    private $DB;

    function __construct($conn)
    {
        $this -> DB = $conn;
    }

    public function Mostrar($consulta)
    {
        $sql = $this -> DB -> prepare($consulta);
        $sql -> execute() > 0;
         
        while($columna = $sql -> fetch(PDO::FETCH_ASSOC))
        {
            ?> 
            <tr>
            <td><?php echo $columna['idpaciente']?></td>
            <td><?php echo $columna['nombre']?></td>
            <td><?php echo $columna['apellido']?></td>
            <td><?php echo $columna['numhistorial']?></td>
            <td><?php echo $columna['telefono']?></td>
            <td><?php echo $columna['direccion']?></td>
            <td>
                <a href="modificar.php?modificarid=<?php echo $columna['idpaciente']?>" class="btn btn-success">
                    Modificar
                </a>
                <a href="eliminar.php?eliminarid=<?php echo $columna['idpaciente']?>" class="btn btn-danger">
                    Eliminar
                </a>
            </td>
        </tr>
            
        <?php
        } 
    }

    public function Actualizar($id, $nombre, $apellido, $numhistorial, $telefono, $direccion)
    {
        try
        {
            $sql = $this -> DB -> prepare("UPDATE pacientes SET nombre=:nombre,
            apellido=:apellido, numhistorial=:numhistorial, telefono=:telefono,
            direccion=:direccion WHERE idpaciente=:idpaciente");
            $sql->bindParam(":nombre", $nombre);
            $sql->bindParam(":apellido", $apellido);
            $sql->bindParam(":numhistorial", $numhistorial);
            $sql->bindParam(":telefono", $telefono);
            $sql->bindParam(":direccion", $direccion);
            $sql->bindParam(":idpaciente", $id);
            $sql->execute();

            return true;
        }
        catch(PDOException $Exc)
        {
            echo $Exc->getMessage();
            return false;
        }
    }

    public function Eliminar($id)
    {
        try
        {
            $sql = $this -> DB -> prepare("DELETE FROM pacientes WHERE idpaciente=:idpaciente");
            $sql->bindParam(":idpaciente", $id);
            $sql->execute();

            return true;
        }
        catch(PDOException $Exc)
        {
            echo $Exc->getMessage();
            return false;
        }
    }
}