<?php

// Ruta dinámica para la imagen
$imageUrl = '/' . $folderBase . 'images/favicons/apple-icon-180x180.png';

//Ruta Dinamica para los links dependiendo de la carpeta
$ruta_link_sesion = '/' . $folderBase . 'logout.php';



function renderMenuOptions($options, $rootTree)
{
    foreach ($options as $option) {

        if (empty($option['submenus'])) {
            if (isset($option['blank'])) {
                echo "<div class='accordion-item boton_none'>";
                echo    '<a href="' . $rootTree . $option['url'] . '" class="btn unico accordion-button" target='.$option['blank'].'><i class="' . $option['favicon'] . '"></i> <span class="ms-1  d-sm-inline">' . $option['label'] . '</span></a>';
                echo "</div>";
            } else {
                echo "<div class='accordion-item boton_none'>";
                echo    '<a href="' . $rootTree . $option['url'] . '" class="btn unico accordion-button"><i class="' . $option['favicon'] . '"></i> <span class="ms-1  d-sm-inline">' . $option['label'] . '</span></a>';
                echo "</div>";
            }
        }

        if (!empty($option['submenus'])) {
            echo "<div class='accordion-item'>";
            echo   ' <h2 class="accordion-header">
                        <button  class="accordion-button collapsed submenus inactivo" type="button" data-bs-toggle="collapse" data-bs-target="#' . $option['idMenu'] . '" aria-expanded="false" aria-controls="' . $option['idMenu'] . '">
                            <i class="' . $option['favicon'] . '"></i><span class="ms-1  d-sm-inline">' . $option['label'] . '</span>
                        </button>
                    </h2>';
            echo "</div>";
            if (isset($option['submenus']) && !empty($option['submenus'])) {
                foreach ($option['submenus'] as $submenu) {
                    if (isset($submenu['blank'])) {
                        echo '<div id="' . $option['idMenu'] . '" class="accordion-collapse collapse boton_none" aria-labelledby="' . $option['idMenu'] . '">';
                        echo  '<a href="' . $rootTree . $submenu['url'] . '" class="btn unico accordion-button "target="_' . $submenu['blank'] . '"><span class="ms-1  d-sm-inline">' . $submenu['label'] . '</span> </a>';
                        echo '</div>';
                    } else {
                        echo '<div id="' . $option['idMenu'] . '" class="accordion-collapse collapse boton_none" aria-labelledby="' . $option['idMenu'] . '">';
                        echo  '<a href="' . $rootTree . $submenu['url'] . '" class="btn unico accordion-button "><span class="ms-1  d-sm-inline">' . $submenu['label'] . '</span> </a>';
                        echo '</div>';
                    }
                }
            }
        }
    }
}

?>
<section class="menu movil">
    <section class='superior'>
        <img src="<?php echo $imageUrl; ?>" alt="logo_acil">
        <div class="boton-responsivo">
            <div>
                <div class="hamburger hamburger--collapse" data-bs-toggle="collapse" data-bs-target="#menu" aria-expanded="false" aria-controls="menu">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class='inferior bloque_footer d-flex align-items-center'>
        <div class='datos_usuario'>
            <p class='m-0 ps-2' style='color: white !important; font-size: small;'><?php echo $partnerName ?> </p>
            <p class='m-0 ps-2' style='color: white !important; font-size: small;'><?php echo $partnerRoleName ?></p>
        </div>
    </section>
    <section class='menu_contenido'>
        <div class='cajacontenido '>
            <div class='accordion collapse navbar-collapse' id='menu'>

                <div class='accordion-item boton_none'>
                    <a href="<?php echo $rootArea ?>" class='btn unico accordion-button '> <i class='fa-solid fa-user-circle'></i><span class='ms-1  d-sm-inline'>Mi cuenta</span> </a>
                </div>
                <?php
                renderMenuOptions($menuOptions, $rootArea);
                ?>
                <div class='accordion-item boton_none'>
                    <a href="<?php echo $ruta_link_sesion ?>" class='btn unico accordion-button '> <i class='fa-solid fa-power-off'></i><span class='ms-1  d-sm-inline'>Cerrar Sesion</span> </a>
                </div>

            </div>
        </div>
    </section>
</section>