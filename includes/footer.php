<?php
/*
 * footer.php
 * Pie de página común: datos de la materia y los integrantes del equipo.
 */
?>
</main>

<footer class="pie">
    <div class="contenedor pie__fila">
        <div>
            <strong><?php echo SITIO_NOMBRE; ?></strong>
            <p><?php echo MATERIA; ?> · <?php echo UNIDAD; ?></p>
            <p>Docente: <?php echo DOCENTE; ?></p>
            <p><?php echo INSTITUCION; ?></p>
        </div>
        <div>
            <strong>Equipo</strong>
            <ul>
                <?php foreach ($equipo as $integrante) : ?>
                    <li><?php echo $integrante; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <p class="pie__copy">&copy; <?php echo date('Y'); ?> · Grupo <?php echo GRUPO; ?> · Página generada a las <?php echo date('H:i:s'); ?></p>
</footer>

</body>
</html>
