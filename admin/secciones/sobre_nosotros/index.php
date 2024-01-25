<?php 
    include("../../bd.php");

    //Borrando registros con el ID...
    if(isset($_GET['txtID'])){

        $txtID=( isset($_GET['txtID']) )?$_GET['txtID']:"";

        $sentencia=$conexion->prepare("SELECT imagen FROM tbl_sobrenosotros WHERE id=:id ");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registros_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($registros_imagen["imagen"])){
  
            if(file_exists("../../../assets/img/about/".$registros_imagen["imagen"])){ 
                unlink("../../../assets/img/about/".$registros_imagen["imagen"]);
            } 
        }

        $sentencia=$conexion->prepare("DELETE FROM tbl_sobrenosotros WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();

    }

    // seleccionar registros
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_sobrenosotros`");
    $sentencia->execute();
    $lista_sobrenosotros=$sentencia->fetchAll(PDO::FETCH_ASSOC);

     
    include("../../templates/header.php");
?>
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
                        <th scope="col">Fecha</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($lista_sobrenosotros as $registros){ ?>

                        <tr class="">
                        <th scope="col"><?php echo $registros['ID'];?></th>
                        <th scope="col"><?php echo $registros['fecha'];?></th>
                        <th scope="col"><?php echo $registros['titulo'];?></th>
                        <th scope="col"><?php echo $registros['descripcion'];?></th>
                        <th scope="col"> <img width="50" src="../../../assets/img/about/<?php echo $registros['imagen'];?>" /></td>
                        </th>
                            <td>  
                                <a name="" id="" class="btn btn-success" href="editar.php?txtID=<?php echo $registros['ID'];?>" role="button">Editar</a>

                                <a name="" id="" class="btn btn-primary" href="index.php?txtID=<?php echo $registros['ID'];?>" role="button">Eliminar</a>
                             </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
         <h5 class="card-title"></h5>
        <p class="card-text"></p>
    </div>
    <div class="card-footer">
             
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
