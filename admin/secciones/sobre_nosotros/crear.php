<?php 
include("../../bd.php"); 
include("../../templates/header.php");

if($_POST){


    $fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:[""];

    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";

    $tmp_imagen=$_FILES["imagen"]["tmp_name"];   
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen,"../../../assets/img/about/".$nombre_archivo_imagen); 
    }


    
    $sentencia=$conexion->prepare("INSERT INTO `tbl_sobrenosotros`
     ( `ID`, `fecha`, `titulo`, `descripcion`, `imagen`)
      VALUES (NULL,:fecha, :titulo, :descripcion, :imagen);");

    $sentencia->bindParam(":fecha",$fecha);
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->execute();

    $mensaje="Registro agregado con exito.";
  header("Location:index.php?mensaje=".$mensaje);

}
 
?>

    <div class="card">
        <div class="card-header">
            Entradas
        </div>
        <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">  
        <label for="fecha" class="form-label">Fecha: </label>
        <input type="date"
            class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha">

        </div>

        <div class="mb-3">
          <label for="" class="form-label">Titulo:</label>
          <input type="text"
            class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo"> 
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Descrpción:</label>
          <input type="text"
            class="form-control" name="descripcion" id="descripcion " aria-describedby="helpId" placeholder="Descripcion">
        </div>

        <div class="mb-3">
          <label for="imagen" class="form-label">Imagen:</label>
          <input type="file"
            class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen">
        </div>

        <button type="submit" class="btn btn-success">Agregar</button>

            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
     
    </form>
       
    </div>
    <div class="card-footer text-muted">

    </div>

</div>


<?php include("../../templates/footer.php"); ?>