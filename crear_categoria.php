<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>


<!--Caja Principal-->
<div id="principal">
  <h1>Crear Categorias</h1>
    <p>Añade nuevas categorías al blog para que
    los usuarios puedan usarlas al crear sus entradas</p>
    <br/>
  <form action="guardar_categoria.php" method="post">
    <label for="nombre">Nombre de la Categoría</label>
    <input type="text" name="nombre" />

    <input type="submit" value="Guardar">
  </form>
</div> <!--Fin principal-->

  <?php require_once 'includes/footer.php'; ?>
