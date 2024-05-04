<?php
if ($rootLeasing == '') {
    $rootLeasing = '#';
} else if ($rootSales == '' || $rootSales == null || $rootSales == 'undefine') {
    $rootSales = '#';
}

$rootPage = [
    'productos' => [
        [
            'image' => '/' . $folderBase . 'images/productos/leasing.svg',
            'url' => "$rootLeasing",
        ],
        [
            'image' => '/' . $folderBase . 'images/productos/ventas.svg',
            'url' => "$rootSales",
        ],
    ],
];

function renderMenu($options, $requireModal)
{
    if (!$requireModal) {
        foreach ($options['productos'] as $option) {
            echo "<div class='col-sm-12 col-md-6 d-flex justify-content-center'>";
            echo '<a href="' . $option['url'] . '"><img src="' . $option['image'] . '" style="width:40vh;"></a>';
            echo "</div>";
        }
    } else {
        
        foreach ($options['productos'] as $option) {
            // $idModal = $option['url'];                                                               |
            // $estructura= "generadorModal('$idModal')";                                               |esto es para JS
            // $url= "onclick=$estructura";                                                             |
            // echo '<a href="#"'.$url.'><img src="' . $option['image'] . '" style="width:40vh;"></a>'; |
            echo "<div class='col-sm-12 col-md-6 d-flex justify-content-center'>";
            echo '<buttom href="#" data-bs-target="#' . $option['url'] . '" data-bs-toggle="modal" style="cursor:pointer;"><img src="' . $option['image'] . '" style="width:40vh;"></buttom>';
            echo "</div>";
        }
    }
}
?>

<section class="container-fluid contenedor-menu">
    <div class="row ms-2 d-flex justify-content-center align-items-center w-100" >
        <?php renderMenu($rootPage, $requireModal); ?>
    </div>
</section>

