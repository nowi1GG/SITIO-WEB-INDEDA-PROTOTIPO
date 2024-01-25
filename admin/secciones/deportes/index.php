<?php 
include("../../bd.php");
if(isset($_GET['txtID'])){

    // Recuperar los datos del ID correspondiente (seleccionado)
    $txtID=( isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia = $conexion->prepare("SELECT imagen  FROM tbl_deportes WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../../../assets/img/deportes/".$registro_imagen["imagen"])){
            unlink("../../../assets/img/deportes/".$registro_imagen["imagen"]);
        }
    }

    //Borrar dicho registro con el ID correspondiente
    $sentencia = $conexion->prepare("DELETE FROM tbl_deportes WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();


}

// seleccionar registros
$sentencia = $conexion->prepare("SELECT * FROM `tbl_deportes`");
$sentencia->execute();
$lista_deportes=$sentencia->fetchAll(PDO::FETCH_ASSOC);


include("../../templates/header.php"); ?>

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Entrenador</th>
                    <th scope="col">Horario</th>
                    <th scope="col">URL</th>
                    <th scope="col">Acciones</th>

                </tr>
            </thead>
            <tbody>
                
                <?php foreach($lista_deportes as $registros){?>
                <tr class="">
                    <td scope="col"><?php echo $registros['ID'];?></td>
                    <td scope="col">
                        
                        <h6><?php echo $registros['titulo'];?></h6>
                        <?php echo $registros['subtitulo'];?>
                
                </td>
                    <td scope="col">
                    <img width="50"  src="../../../assets/img/deportes/<?php echo $registros['imagen'];?>"/> 
                </td>
                    <td scope="col"><?php echo $registros['descripcion'];?></td>
                    <td scope="col"><?php echo $registros['entrenador'];?></td>
                    <td scope="col"><?php echo $registros['horario'];?></td>
                    <td scope="col"><?php echo $registros['url'];?></td>
                    <td scope="col">

                        <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID'];?>" role="button">Editar</a>
                        |
                        <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID'];?>" role="button">Eliminar</a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
