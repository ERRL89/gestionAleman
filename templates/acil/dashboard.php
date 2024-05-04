<?php
$partnerPhoto = '/' . $folderBase . 'images/partners/' . $partnerPhotoName;


$dashboard = "
    <section class='row g-0 mt-4 mb-4'>
        <div class='perfil'>
            <div class='perfil-foto'>
                <img src='$partnerPhoto' alt='foto' class='img-fluid' style='border-radius:100%;'>
            </div>
            <div class='perfil-datos margin-perfil'>
                <center>
                <h3 class='mb-3 mt-3'>  $partnerName</h3>
                <!--<h5 class=' ps-2'>  $partnerAreaName</h5>-->
                <h5 class=' ps-2'>  $partnerRoleName</h5>
                <h5 class=' ps-2'>Sucursal:  $partnerBranch</h5>
                </center>
            </div>
        </div>
    </section>
";

echo $dashboard;

?>
