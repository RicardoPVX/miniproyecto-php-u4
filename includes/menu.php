<?php
/*
 * menu.php
 * Menú de navegación común. Se genera con un arreglo asociativo y un foreach;
 * con un if se marca la página en la que está el usuario.
 */
$paginas_menu = [
    'index.php'         => 'Inicio',
    'variables.php'     => 'Variables',
    'condicionales.php' => 'Condicionales',
    'bucles.php'        => 'Bucles',
    'arreglos.php'      => 'Arreglos',
    'sesiones.php'      => 'Sesiones',
];

$pagina_abierta = basename($_SERVER['PHP_SELF']);
?>
<nav class="menu" aria-label="Menú principal">
    <ul class="contenedor menu__lista">
        <?php foreach ($paginas_menu as $archivo => $etiqueta) : ?>
            <?php if ($archivo === $pagina_abierta) : ?>
                <li><a class="activo" href="<?php echo $archivo; ?>" aria-current="page"><?php echo $etiqueta; ?></a></li>
            <?php else : ?>
                <li><a href="<?php echo $archivo; ?>"><?php echo $etiqueta; ?></a></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</nav>
