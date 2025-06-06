<?php include("template/cabecera.php"); ?>

 <?php 
 
$txtCeduladeidentidad=(isset($_POST['txtCedula de identidad']))?$_POST['txtCedula de identidad']:""; 

$txtNombreyApellido=(isset($_POST['txtNombre y Apellido']))?$_POST['txtNombre y Apellido']:""; 

$txtEstudioacademico=(isset($_POST['txtEstudio academico']))?$_POST['txtEstudio academico']:""; 

$txtseccion=(isset($_POST['txtseccion']))?$_POST['txtseccion']:""; 

$txtImagendelestudiante=(isset($_POST['txtImagen del estudiante']))?$_POST['txtImagen del estudiante']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("config/bd.php");

switch($accion){

        case "Agregar":

            $sentenciaSQL= $conexcion->prepare("INSERT INTO `estudiantes` (`cedula de identidad`, `nombre y apellido`, `estudio académico`, `sección`, `imagen del estudiante`) VALUES (:'2', :'rodrigo nuñes', :'electronica', :'2b', :'estudiante 1');");
            $sentenciaSQL->bindparam(':Ceduladeidentidad',$txtCeduladeidentidad);

            $fecha= new DateTime();
            $CeduladeidentidadArchivo=($txtImagendelestudiante!="")?$fecha->getTimestamp()."_".$_FILES["txtImagendelestudiante"]["name"]:"imagen.jpg";

            $tmpImagen=$_FILES["txtImagendelestudiante"]["tmp_name"];

            if($tmpImagen!=""{

              move_uploaded_file($tmpImagen,"../../img/".$CeduladeidentidadArchivo);

            }

            $sentenciaSQL->bindparam(':imagendelestudiante', $CeduladeidentidadArchivo);
            $sentenciaSQL->execute();
            break;
    
        case "Modificar":

          $sentenciaSQL= $conexcion->prepare("UPDATE estudiantes set cedula de identidad=:cedula de identidad WHERE Ceduladeidentidad=:Ceduladeidentidad");
          $sentenciaSQL->bindparam(':Ceduladeidentidad',$txtCeduladeidentidad);
          $sentenciaSQL->execute();



          if($txtImagendelestudiante!=""){
            $fecha= new DateTime();
            $CeduladeidentidadArchivo=($txtImagendelestudiante!="")?$fecha->getTimestamp()."_".$_FILES["txtImagendelestudiante"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagendelestudiante"]["tmp_name"];

            move_uploaded_file($tmpImagen,"../../img/".$CeduladeidentidadArchivo);

            $sentenciaSQL= $conexcion->prepare("DELETE  FROM estudiantes WHERE Ceduladeidentidad=:Ceduladeidentidad");
          $sentenciaSQL->bindparam(':Ceduladeidentidad',$txtCeduladeidentidad);
          $sentenciaSQL->execute();
        
        break;

        if(isset($libro["imagen"]) &&($libro["imagen"]!="imagen.jpg") ){

          if(file_exists("../../img/".$estudiantes["imagen"])){
            
            unlink("../../img/".$estudiantes["imagen"]);

          }

}



          $sentenciaSQL= $conexcion->prepare("UPDATE estudiantes set imagendelestudiante=:imagendelestudiante WHERE Ceduladeidentidad=:Ceduladeidentidad");
          $sentenciaSQL->bindparam(':imagendelestudiante',$txtnombreArchivo);
          $sentenciaSQL->bindparam(':cedula de identidad',$txtCeduladeidentidad);
          $sentenciaSQL->execute();

          } 
        header("Location:index.php");
        break;

        case "Cancelar":
         header("Location:index.php");
        break;

        case "Seleccionar":

          $sentenciaSQL= $conexcion->prepare("SELECT * FROM estudiantes WHERE Ceduladeidentidad=:Ceduladeidentidad");
          $sentenciaSQL->bindparam(':Ceduladeidentidad',$txtCeduladeidentidad);
          $sentenciaSQL->execute();
          $estudiantes=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

          $txtCeduladeidentidad=$estudiantes[''];
          
        //echo"presionado boton Seleccionar";
        break;

        case "Borrar":
          $sentenciaSQL= $conexcion->prepare("DELETE  FROM estudiantes WHERE Ceduladeidentidad=:Ceduladeidentidad");
          $sentenciaSQL->bindparam(':Ceduladeidentidad',$txtCeduladeidentidad);
          $sentenciaSQL->execute();
        //echo"presionado boton Borrar";
        break;

        if(isset($libro["imagen"]) &&($libro["imagen"]!="imagen.jpg") ){

          if(file_exists("../../img/".$estudiantes["imagen"])){
            
            unlink("../../img/".$estudiantes["imagen"]);

          }

}
 
         $sentenciaSQL=$conexcion->prepare("SELECT * FROM estudiantes");
         $sentenciaSQL->execute();
         $listaestudiantes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);¨
         

 ?>
            
<div class="col-md-5">

  <div class="card">
    <div class="card-header">
        Datos del estudiante
    </div>

    <div class="card-body">
    <form  method="post" enctype="multipart/form-data" >

 <div class = "form-group">
 <label for="exampleInputEmail1">Cedula de identidad</label>
 <input type="text" required readonly class="form-control" name="txtCedula de identidad" id="txttxtCedula de identidad"  placeholder="Cedula de identidad">
 </div>



 <div class = "form-group">
 <label for="exampleInputEmail1">Nombre y Apellido:</label>
 <input type="text" required class="form-control" name="txtNombre y Apellido" id="txtNombre y Apellido"  placeholder="Nombre y apellido">
 </div>



 <div class = "form-group">
 <label for="exampleInputEmail1">Estudio academico:</label>
 <input type="text" required class="form-control" name="txtEstudio academico" id="txtEstudio academico"  placeholder="Estudio academico">
 </div>


 <div class = "form-group">
 <label for="exampleInputEmail1">seccion:</label>
 <input type="text" required class="form-control" name="txtseccion" id="txtseccion"  placeholder="seccion">
 </div>



 

 <div class = "form-group">
 <label for="txtNombre">Imagen del estudiante</label>

 <br/>


<?php 

 if($txtImagen!=){ ?>

 <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" width="50" alt="" srcset="">
 


<?php } ?>


 <input type="file" class="form-control" name="txtImagen del estudiante" id="txtImagen del estudiante"  placeholder="Imagen del estudiante">
 </div>
    

 <div class="btn-group" role="group" aria-label="">
    <button type="button" name="accion" <?php echo ($accion=="Selecionar")?"disabled":"";?> value="Agregar" class="btn btn-success">Agregar</button>
    <button type="button" name="accion" <?php echo ($accion!="Selecionar")?"disabled":"";?> value="Modificar" class="btn btn-warning">Modificar</button>
    <button type="button" name="accion" <?php echo ($accion!="Selecionar")?"disabled":"";?> value="Cancelar" class="btn btn-info">Cancelar</button>
 </div>

 </form>
   

    </div>

   
  </div>

 <div class="col-md-7">
    tablas de los estudiantes

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Cedula de identidad</th>
            <th>Nombre y apellido</th>
            <th>Estudio academico</th>
            <th>Seccion</th>
            <th>Imagen del estudiante</th>
            <th>Acciones</th>
        </tr>

      </thead>
      
      <tbody>
        

<?php foreach($listaestudiantes as $estudiantes) { ?>

        <tr>
          <td><?php echo $estudiante['cedula de identidad']; ?></td>
          <td><?php echo $estudiante['nombre y apellido']; ?></td>
          <td><?php echo $estudiante['estudio academico']; ?></td>
          <td><?php echo $estudiante['seccion']; ?></td>
          <td>
            
          <img class="img-thumbnail rounded" src="../../img/<?php echo $estudiante['imagen del estudiante']; ?>" width="50" alt="" srcset="">

          
        
         </td>



          <td>
            
          Seleccionar|Borrar

        <form method="post">
          
        <input type="hidden" name="txtcedula de identidad" id="txtcedula de identidad" value="<?php echo $estudiante['cedula de identidad']; ?>"/> 

          <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>

          <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>

        </form>
        
        </td>



        </tr>  
         <?php } ?>
      </tbody>
    </table>

 
</div>


<?php include("template/pie.php"); ?>


