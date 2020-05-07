<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<?php
  $entrada_actual = conseguirEntrada($db, $_GET['id']);
/*  var_dump($entrada_actual);
  die(); */
  if(!isset($entrada_actual['id'])){
    header("Location: index.php");
  }


?>
<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>

<!--Caja Principal-->
<div id="principal">

  <h1><?=$entrada_actual['titulo']?></h1>
<a href="categoria.php?id=<?=$entrada_actual['categoria_id']?>">
  <h2><?=$entrada_actual['Categoría']?></h2>
</a>
  <h4><?=$entrada_actual['fecha']?> | <?=$entrada_actual['Usuario']?></h4>
  <p><?=$entrada_actual['descripcion']?></p>

<?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']):?>

<?php endif; ?>
<br/>
<a href="editar_entrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-verde">Editar Entrada</a>
<a href="borrar_entrada.php?id=<?=$entrada_actual['id']?>" class="boton">Borrar Entrada</a>
</div>
  <?php require_once 'includes/footer.php'; ?>
