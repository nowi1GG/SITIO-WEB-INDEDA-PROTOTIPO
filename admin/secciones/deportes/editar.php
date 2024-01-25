<?php 

include("../../bd.php");

if(isset($_GET['txtID'])){

    // Recuperar los datos del ID correspondiente (seleccionado)
    $txtID=( isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_deportes WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_ASSOC);

    $titulo=$registro['titulo'];
    $subtitulo=$registro['subtitulo'];
    $imagen=$registro['imagen'];
    $descripcion=$registro['descripcion'];
    $entrenador=$registro['entrenador'];
    $horario=$registro['horario'];
    $url=$registro['url'];

    

}
if($_POST){
    
    
    // Recepcionamos los valores del forumulario
    $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $subtitulo = (isset($_POST["subtitulo"])) ? $_POST["subtitulo"] : "";
    $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"] : "";
    $entrenador = (isset($_POST["entrenador"])) ? $_POST["entrenador"] : "";
    $horario = (isset($_POST["horario"])) ? $_POST["horario"] : "";
    $url = (isset($_POST["url"])) ? $_POST["url"] : "";

    $sentencia = $conexion->prepare("UPDATE tbl_deportes 
    SET 
    titulo=:titulo,
    subtitulo=:subtitulo, 
    descripcion=:descripcion,
    entrenador=:entrenador,
    horario=:horario,
    url=:url
    WHERE id=:id");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":subtitulo", $subtitulo);
    $sentencia->bindParam(":descripcion", $descripcion);

    $sentencia->bindParam(":entrenador", $entrenador);
    $sentencia->bindParam(":horario", $horario);
    $sentencia->bindParam(":url", $url);

    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    if($_FILES["imagen"]["name"]!=""){
      
      $imagen=(isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] :"";
      $fecha_imagen=new DateTime();
      $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen:"";

      $tmp_imagen=$_FILES["imagen"]["tmp_name"];
   
      move_uploaded_file($tmp_imagen,"../../../assets/img/deportes/".$nombre_archivo_imagen);
      
      //Borrado del archivo anterior
      $sentencia = $conexion->prepare("SELECT imagen  FROM tbl_deportes WHERE id=:id");
      $sentencia->bindParam(":id", $txtID);
      $sentencia->execute();
      $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);
  
      if(isset($registro_imagen["imagen"])){
          if(file_exists("../../../assets/img/deportes/".$registro_imagen["imagen"])){
              unlink("../../../assets/img/deportes/".$registro_imagen["imagen"]);
          }
      }

      $sentencia = $conexion->prepare("UPDATE tbl_deportes SET imagen=:imagen WHERE id=:id");
      $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
      $sentencia->bindParam(":id", $txtID);
      $sentencia->execute();
    }

    $mensaje="Registro agregado con exito.";
    header("Location:index.php?mensaje=".$mensaje);


}

include("../../templates/header.php"); 

?>

<div class="card">
    <div class="card-header">
        Edicion de Deportes
    </div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">
  
  <div class="mb-3">
    <label for="txtID" class="form-label">ID</label>
    <input type="text"
      class="form-control" 
      readonly
      name="txtID" 
      id="txtID" 
      value="<?php echo $txtID;?>"
      aria-describedby="helpId" placeholder="">
  </div>
 
 <div class="mb-3">
  <label for="titulo" class="form-label">Titulo:</label>
  <input type="text"
    class="form-control" value="<?php echo $titulo;?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo">
</div>

<div class="mb-3">
  <label for="subtitulo" class="form-label">Subtitulo:</label>
  <input type="text"
    class="form-control" value="<?php echo $subtitulo;?>" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="Subtitulo">
  </div>

 <div class="mb-3">
   <label for="imagen" class="form-label">Imagen:</label>
   
   <img width="50"  src="../../../assets/img/deportes/<?php echo $imagen;?>"/> 
   <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId">
 </div>


    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripcion:</label>
      <input type="text"
        class="form-control" value="<?php echo $descripcion;?> "name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion">
    </div>

 <div class="mb-3">
   <label for="entrenador" class="form-label">Entrenador:</label>
   <input type="text"
     class="form-control" value="<?php echo $entrenador;?>" name="entrenador" id="entrenador" aria-describedby="helpId" placeholder="Entrenador">
 </div>

 <div class="mb-3">
   <label for="horario" class="form-label">Horario:</label>
   <input type="text"
     class="form-control" value="<?php echo $horario;?>" name="horario" id="horario" aria-describedby="helpId" placeholder="Horario">
 </div>

 <div class="mb-3">
   <label for="url" class="form-label">URL:</label>
   <input type="text"
     class="form-control" value="<?php echo $url?>" name="url" id="url" aria-describedby="helpId" placeholder="URL">
 </div>

 <button type="submit" class="btn btn-success">Actualizar</button>

<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


 </form>

    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>


<?php include("../../templates/footer.php"); ?>