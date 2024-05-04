<?php



echo "
    <div class='containerTable-Main' onload='crearTabla($idTable)'>
        <div class='container-table mt-4'>
            <div>
                <table id='$idTable' class='display nowrap' style='width: 100%; height: 100%;'>
                    <thead>
                         $headTable
                    </thead>
                    <tbody>
                         $bodyTable
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    ";

?>