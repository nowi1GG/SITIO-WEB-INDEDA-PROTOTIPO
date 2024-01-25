<?php 
include("../../bd.php");
if ($_POST) {

    // Recepcionamos los valores del formulario
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $subtitulo = (isset($_POST["subtitulo"])) ? $_POST["subtitulo"] : "";
    $imagen=(isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] :"";
    $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";
    $entrenador = (isset($_POST["entrenador"])) ? $_POST["entrenador"] : "";
    $horario = (isset($_POST["horario"])) ? $_POST["horario"] : "";
    $url = (isset($_POST["url"])) ? $_POST["url"] : "";


    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";
    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
      move_uploaded_file($tmp_imagen,"../../../assets/img/deportes/".$nombre_archivo_imagen);
    }

    $sentencia = $conexion->prepare("INSERT INTO `tbl_deportes` 
    (`ID`, `titulo`, `subtitulo`, `imagen`, `descripcion`, `entrenador`, `horario`, `url`)
     VALUES (NULL,:titulo,:subtitulo,:imagen,:descripcion,:entrenador,:horario, :url);");

     $sentencia->bindParam(":titulo", $titulo);
     $sentencia->bindParam(":subtitulo", $subtitulo);
     $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
     $sentencia->bindParam(":descripcion", $descripcion);
     $sentencia->bindParam(":entrenador", $entrenador);
     $sentencia->bindParam(":horario", $horario);
     $sentencia->bindParam(":url", $url);
     $sentencia->execute();
     $mensaje="Registro agregado con exito.";
     header("Location:index.php?mensaje=".$mensaje);
     
}
include("../../templates/header.php"); 

?>
<div class="card">
    <div class="card-header">
        Deporte 
    </div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">
 
 <div class="mb-3">
  <label for="titulo" class="form-label">Titulo:</label>
  <input type="text"
    class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo">
</div>

<div class="mb-3">
  <label for="subtitulo" class="form-label">Subtitulo:</label>
  <input type="text"
    class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="Subtitulo">
  </div>

 <div class="mb-3">
   <label for="imagen" class="form-label">Imagen:</label>
   <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId">
 </div>


    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripcion:</label>
      <input type="text"
        class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion">
    </div>

 <div class="mb-3">
   <label for="entrenador" class="form-label">Entrenador:</label>
   <input type="text"
     class="form-control" name="entrenador" id="entrenador" aria-describedby="helpId" placeholder="Entrenador">
 </div>

 <div class="mb-3">
   <label for="horario" class="form-label">Horario:</label>
   <input type="text"
     class="form-control" name="horario" id="horario" aria-describedby="helpId" placeholder="Horario">
 </div>

 <div class="mb-3">
   <label for="url" class="form-label">URL:</label>
   <input type="text"
     class="form-control" name="url" id="url" aria-describedby="helpId" placeholder="URL">
 </div>

 <button type="submit" class="btn btn-success">Agregar</button>

<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


 </form>

    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>






<?php include("../../templates/footer.php"); ?>