<?php require_once 'includes/redireccion.php'; ?>
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
  <h1>Editar Entradas</h1>
    <p>Edita tu entrada <?=$entrada_actual['titulo']?> </p>
    <br/>
  <form action="guardar_entrada.php?editar=<?=$entrada_actual['id']?>" method="post">
    <label for="titulo">Titulo</label>
    <input type="text" name="titulo" value="<?=$entrada_actual['titulo']?>" />
    <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'titulo') : ''; ?>

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" ><?=$entrada_actual['descripcion']?></textarea>
    <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'descripcion') : ''; ?>

    <label for="categoria">Categoría</label>
    <select name="categoria"/>
      <?php
        $categorias = listarCategorias($db);
        if (!empty($categorias)):
        while ($categoria = mysqli_fetch_assoc($categorias)) :
       ?>
    <option value="<?=$categoria['id']?>" <?=($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected"' : ''?>>
      <?=$categoria['nombre']?>
    </option>
      <?php
        endwhile;
        endif;
      ?>
    </select>
    <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'categoria') : ''; ?>

    <input type="submit" value="Guardar">
  </form>
  <?php borrarErrores(); ?>
</div> <!--Fin principal-->





<?php require_once 'includes/footer.php'; ?>
