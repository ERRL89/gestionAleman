<?php
$imageLogin = '/' . $folderBase . 'images/logos/'.$imageLogo;
$validateLogin = '/' . $folderBase . 'validateLogin.php';
?>


<!--Login-->
<div class="cajalogin text-center">
    <form action="<?php echo $validateLogin ?>" method="post" class="needs-validation" novalidate>
        <div class="logo_fondo">
            <img class="mb-4" src=<?php echo $imageLogin ?> alt="" style="width: 15rem;">
        </div>
        <h1 class="h3 mb-3 fw-normal textologin">Acceder al portal</h1>

        <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="user" required>
            <label for="floatingInput">Usuario</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass" required>
            <label for="floatingPassword">Contraseña</label>
        </div>
        <div class="checkbox mb-3">
            <!--<label>
                        <input type="checkbox" value="remember-me"> Recordar cuenta.
                    </label>-->
        </div>
        <button class="btn_login mb-3 w-100 btn btn-lg  " type="submit">Iniciar sesión</button>

        <!--<div class="form-floating">
            <p class="olvidar_contraseña" data-bs-toggle="modal" data-bs-target="#lostPassword">¿Olvidaste tu contraseña?</p>
        </div>-->
    </form>
</div>
<!--Login-->

<!--Ventana recuperar contraseña-->
<div class="modal fade" id="lostPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="#" class="needs-validation" method="POST" novalidate>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Recuperar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Ingrese el correo electronico donde se enviará la contraseña</label>
                        <input type="email" class="form-control" id="correo_recuperar" name="correo_recuperar" aria-describedby="emailHelp" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-modal" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-modal">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--Ventana recuperar contraseña-->

<!-- Codigo para la validación de campos vacios -->
<script type="text/javascript">
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
<!-- Codigo para la validación de campos vacios -->
