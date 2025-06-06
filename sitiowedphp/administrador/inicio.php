
<?php 
session_start();
 if($_POST){
    if(($_POST['usuario']=="jostin")&&($_POST['contraseña']=="sistema")){

      $_SESSION['usuario']="ok";
      $_SESSION["nombreUsuario"]="Jostin";
      header('Location:inicio.php');

    }else{

        $_mensaje="Error: El usuario o contraseña son incorrectos";
    }
   
    
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administrador</title>
     <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
     
    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>

<?php  $url="http://".$_SERVER['HTTP_HOST']."/sitiowedphp" ?>

    <nav class="navar navar-expand navbar-light bg-light">
        <div class="nav navbar nav">
            <a class="nav item nav-link active" herf="<?php echo $url;?>">inicio</a>
            <a class="nav item nav-link active" herf="#">estudiantes</a>

        </div>
    </nav>      

    <div class="container">
        <div class="row">  

