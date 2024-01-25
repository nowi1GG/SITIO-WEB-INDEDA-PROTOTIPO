<?php

include("../../bd.php");

if (isset($_GET['txtID'])) {
    // Recuperar los datos del ID correspondiente ( seleccionado )
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM tbl_servicios WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $imagen = $registro['imagen'];
    $titulo = $registro['titulo'];
    $descripcion = $registro['descripcion'];
}

if ($_POST) {


    // Recepcionamos los valores del formulario
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";


    $sentencia = $conexion->prepare("UPDATE tbl_servicios 
        SET  
        titulo=:titulo, 
        descripcion=:descripcion
        WHERE id=:id");


    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    if ($_FILES["imagen"]["tmp_name"] != "") {

        $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : [""];
        $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : "";
        $nombre_archivo_imagen = ($imagen != "") ? $imagen . "_" . $imagen : "";

        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";

        $tmp_imagen = $_FILES["imagen"]["tmp_name"];

        move_uploaded_file($tmp_imagen, "../../../assets/img/servicios/" . $nombre_archivo_imagen);
        //borrando archivo interior//
        $sentencia = $conexion->prepare("SELECT imagen FROM tbl_servicios WHERE id=:id ");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);


        if (isset($registro_imagen["imagen"])) {
            if (file_exists("../../../assets/img/servicios/" . $registro_imagen["imagen"])) {
                 unlink("../../../assets/img/servicios/" . $registro_imagen["imagen"]);
            }
        }

        $sentencia = $conexion->prepare("UPDATE tbl_servicios SET imagen=:imagen WHERE id=:id");
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
    }

    $mensaje = "Registro modificado con exito.";
    header("Location:index.php?mensaje=" . $mensaje);
}

include("../../templates/header.php");

?>

<div class="card">

    <div class="card-header">
        Editando la informacion de servicios
    </div>

    <div class="card-body">

        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input readonly value="<?php echo $txtID ?>" type="text" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">


            </div>
            <div class="mb-3">
                <img width="50" src="../../../assets/img/servicios/<?php echo $imagen; ?>" />
                <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen">
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input value="<?php echo $titulo ?>" type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input value="<?php echo $descripcion ?>" type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>

            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>

    <div class="card-footer text-muted">

    </div>
</div>


<?php include("../../templates/footer.php"); ?>