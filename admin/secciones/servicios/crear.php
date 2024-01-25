<?php
include("../../bd.php");

if ($_POST) {

    // Recepcionamos los valores del formulario
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:[""];
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";

    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];   
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen,"../../../assets/img/servicios/".$nombre_archivo_imagen); 
    }


    $sentencia = $conexion->prepare("INSERT INTO `tbl_servicios` (`ID`, `imagen`, `titulo`, `descripcion`) VALUES (NULL, :imagen, :titulo, :descripcion);");

    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);

    $sentencia->execute();
    $mensaje="Registro agregado con exito.";
        header("Location:index.php?mensaje=".$mensaje);
}

include("../../templates/header.php");



?>

<div class="card">

    <div class="card-header">
        Crear servicios
    </div>

    <div class="card-body">

        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen">
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>

            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>

    <div class="card-footer text-muted">

    </div>
</div>

<?php include("../../templates/footer.php"); ?>