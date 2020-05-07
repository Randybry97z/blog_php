<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>


<!--Caja Principal-->
<div id="principal">
  <h1>Crear Entradas</h1>
    <p>Añade nuevas entradas al blog para que
    los usuarios puedan leerlas y disfrutar de nuestro
    contenido </p>
    <br/>
  <form action="guardar_entrada.php" method="post">
    <label for="titulo">Titulo</label>
    <input type="text" name="titulo" />
    <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'titulo') : ''; ?>

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion"></textarea>
    <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'descripcion') : ''; ?>

    <label for="categoria">Categoría</label>
    <select name="categoria" />
      <?php
        $categorias = listarCategorias($db);
        if (!empty($categorias)):
        while ($categoria = mysqli_fetch_assoc($categorias)) :
       ?>
    <option value="<?=$categoria['id']?>">
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
