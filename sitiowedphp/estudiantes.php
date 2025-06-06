<?php include("template/cabecera.php"); ?>

<?php
include("administrador/config/bd.php");
$sentenciaSQL=$conexcion->prepare("SELECT * FROM estudiantes");
$sentenciaSQL->execute();
$listaestudiantes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);¨
?>

<?php foreach($listaestudiantes as $estudiantes){ ?>
<div class="col-md-3">  
<div class="card">
<img class="card-img-top" src=./img/<?php echo $estudiantes['imagen']; ?> alt="">
<div class="card-body">
    <h4 class="card-title"><?php echo $estudiantes['nombre']; ?></h4>
    <a name="" id="" class="btn btn-primary" href="#" role="button">ver informacion</a>
</div>
</div>
</div>
<?php } ?>

<?php include("template/pie.php"); ?>


