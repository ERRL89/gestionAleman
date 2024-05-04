<?php
    #DEFINICION DE PARAMETROS A ENVIAR EN FUNCIÓN
    $inputForm = "form";
    $routeProcess = "newPriceProcessGenerate.php";
    $generalCanvas = "principal";
    $table = "";
    $elementsToHide = "formulario"; //Se deben separar con comas los elementos debido a que se ingresan en un array
    $optionalFunction = "";

    #CONSTRUCCIÓN DE FUNCIÓN
    $functionParameters = " 
    getProcessForm(
        '{$inputForm}',  
        '{$routeProcess}', 
        '{$generalCanvas}', 
        '{$table}', 
        '{$elementsToHide}', 
        {$optionalFunction}
    );
                        ";
?>

<!-- Formulario de Contrato -->
<div id="formulario" class="container p-5 mb-5">
  <form id="form">
    <div class="container-sm container_form_custom">

    <div class="d-flex justify-content-end align-items-center gap-2"><!-- Fecha -->
        <?php
            $fecha = date('d-m-Y');
        ?>
        <label for="fecha" class="form-label label-custom">Fecha:</label>
          <div class="col-md-2 mb-2">
            <input type="text" class="text-center form-control form-input" id="fecha" name="fecha" value='<?php echo $fecha?>' disabled>
          </div>
    </div>

    <hr><center><p class="fs-5"><b>DATOS DEL CLIENTE</b></p></center><hr>

    <!-- --- DATOS DE CLIENTE --- -->
    <!-- Nombre, Telefono - Email -->
    <div class="mb-3">
        <div class="row mb-3">
          <div class="col-md-5 mb-2">
            <input type="text" class="form-control form-input" id="nombre" name="nombre" placeholder="Nombre/Razón Social" required>
            <div class="invalid-feedback">Introduce el nombre/razón social</div>
          </div>
          <div class="col-md-3 mb-2">
            <input type="text" class="form-control form-input" placeholder="Telefono" id="telefono" name="telefono" required>
            <div class="invalid-feedback">Introduce telefono</div>
          </div>
          <div class="col-md-4 mb-2">
            <input type="text" class="form-control form-input" placeholder="Email" id="email" name="email" required>
            <div class="invalid-feedback">Introduce email</div>
          </div>
        </div>
    </div>

    <hr><center><p class="fs-5"><b>SERVICIOS A COTIZAR</b></p></center><hr>

    <!-- Servicio 1 -->
    <div  id="containerServices1" class="row mt-3 mb-3">
        <div class="col-md-3"><!-- Tipo de Servicio -->
            <label for="typeService1" class="form-label label-custom">Tipo de Servicio:</label>
                <select class="form-select" id="typeService1" name="typeService1" aria-label="Default select example" required>
                  <option selected disabled>Seleccione tipo de Servicio</option>
                  <option value="MANIOBRAS ENTARIMADAS">MANIOBRAS ENTARIMADAS</option>
                  <option value="MANIOBRAS A GRANEL">MANIOBRAS A GRANEL</option>
                  <option value="MAQUILA">MAQUILA</option>
                  <option value="MAQUILA ESPECIALIZADA">MAQUILA ESPECIALIZADA</option>
                  <option value="RENTA DE PATIN">RENTA DE PATIN</option>
                  <option value="PERSONA ADICIONAL">PERSONA ADICIONAL</option>
                </select>
            <div class="invalid-feedback">Seleccione Tipo de Servicio</div>
        </div>

        <div class="col-md-5"><!-- Seleccion de Servicio -->
            <label for="service1" class="form-label label-custom">Servicio:</label>
                <select class="form-select" id="service1" name="service1" required>
                    <option disabled>Seleccione servicio:</option>
                </select>
            <div class="invalid-feedback">Seleccione Servicio</div>
        </div>

        <div class="col-md-1"><!-- Cantidad -->
            <label for="cantidad1" class="form-label label-custom">Cantidad:</label>
            <input type="number" class="form-control form-input" id="cantidad1" name="cantidad1" required disabled>
            <div class="invalid-feedback">Introduce cantidad</div>
        </div>

        <div class="col-md-2"><!-- Costo -->
            <label for="costo1" class="form-label label-custom">Costo($):</label>
            <input type="number" class="form-control form-input" id="costo1" name="costo1" required disabled>
            <div class="invalid-feedback">Introduce costo</div>
        </div>

        <div id="numPersonaContainer1" class="col-md-1"><!-- Num. Personas -->
            <label for="numPersona1" class="form-label label-custom">Personas:</label>
            <input type="number" class="text-center form-control form-input" id="numPersona1" name="numPersona1" required disabled>
            <div class="invalid-feedback">Introduce numero de personas</div>
        </div>
    </div>

    <!-- Servicio 2 -->
    <div  id="containerServices2" class="row mt-3 mb-3">
        <div class="col-md-3"><!-- Tipo de Servicio 2 -->
            <label for="typeService2" class="form-label label-custom">Tipo de Servicio:</label>
                <select class="form-select" id="typeService2" name="typeService2" required>
                  <option selected disabled>Seleccione tipo de Servicio</option>
                  <option value="MANIOBRAS ENTARIMADAS">MANIOBRAS ENTARIMADAS</option>
                  <option value="MANIOBRAS A GRANEL">MANIOBRAS A GRANEL</option>
                  <option value="MAQUILA">MAQUILA</option>
                  <option value="MAQUILA ESPECIALIZADA">MAQUILA ESPECIALIZADA</option>
                  <option value="RENTA DE PATIN">RENTA DE PATIN</option>
                  <option value="PERSONA ADICIONAL">PERSONA ADICIONAL</option>
                </select>
            <div class="invalid-feedback">Seleccione Tipo de Servicio</div>
        </div>

        <div class="col-md-5"><!-- Seleccion de Servicio 2-->
            <label for="service2" class="form-label label-custom">Servicio:</label>
                <select class="form-select" id="service2" name="service2">
                    <option disabled>Seleccione servicio:</option>
                </select>
            <div class="invalid-feedback">Seleccione Servicio</div>
        </div>

        <div class="col-md-1"><!-- Cantidad 2-->
            <label for="cantidad2" class="form-label label-custom">Cantidad:</label>
            <input type="number" class="form-control form-input" id="cantidad2" name="cantidad2" required disabled>
            <div class="invalid-feedback">Introduce cantidad</div>
        </div>

        <div class="col-md-2"><!-- Costo 2-->
            <label for="costo2" class="form-label label-custom">Costo($):</label>
            <input type="number" class="form-control form-input" id="costo2" name="costo2" required disabled>
            <div class="invalid-feedback">Introduce costo</div>
        </div>

        <div id="numPersonaContainer2" class="col-md-1"><!-- Num. Personas 2-->
            <label for="numPersona2" class="form-label label-custom">Personas:</label>
            <input type="number" class="text-center form-control form-input" id="numPersona2" name="numPersona2" required disabled>
            <div class="invalid-feedback">Introduce numero de personas</div>
        </div>
    </div>

    <!-- Servicio 3 -->
    <div  id="containerServices3" class="row mt-3 mb-3">
        <div class="col-md-3"><!-- Tipo de Servicio 3 -->
            <label for="typeService3" class="form-label label-custom">Tipo de Servicio:</label>
                <select class="form-select" id="typeService3" name="typeService3" required>
                  <option selected disabled>Seleccione tipo de Servicio</option>
                  <option value="MANIOBRAS ENTARIMADAS">MANIOBRAS ENTARIMADAS</option>
                  <option value="MANIOBRAS A GRANEL">MANIOBRAS A GRANEL</option>
                  <option value="MAQUILA">MAQUILA</option>
                  <option value="MAQUILA ESPECIALIZADA">MAQUILA ESPECIALIZADA</option>
                  <option value="RENTA DE PATIN">RENTA DE PATIN</option>
                  <option value="PERSONA ADICIONAL">PERSONA ADICIONAL</option>
                </select>
            <div class="invalid-feedback">Seleccione Tipo de Servicio</div>
        </div>

        <div class="col-md-5"><!-- Seleccion de Servicio 3-->
            <label for="service3" class="form-label label-custom">Servicio:</label>
                <select class="form-select" id="service3" name="service3">
                    <option disabled>Seleccione servicio:</option>
                </select>
            <div class="invalid-feedback">Seleccione Servicio</div>
        </div>

        <div class="col-md-1"><!-- Cantidad 3-->
            <label for="cantidad3" class="form-label label-custom">Cantidad:</label>
            <input type="number" class="form-control form-input" id="cantidad3" name="cantidad3" required disabled>
            <div class="invalid-feedback">Introduce cantidad</div>
        </div>

        <div class="col-md-2"><!-- Costo 3-->
            <label for="costo3" class="form-label label-custom">Costo($):</label>
            <input type="number" class="form-control form-input" id="costo3" name="costo3" required disabled>
            <div class="invalid-feedback">Introduce costo</div>
        </div>

        <div id="numPersonaContainer3" class="col-md-1"><!-- Num. Personas 3-->
            <label for="numPersona3" class="form-label label-custom">Personas:</label>
            <input type="number" class="text-center form-control form-input" id="numPersona3" name="numPersona3" required disabled>
            <div class="invalid-feedback">Introduce numero de personas</div>
        </div>
    </div>    

    <!-- ------------------------TOTAL----------------------------------------- -->
    <div  id="containerTotal" class="row mt-3 mb-3 justify-content-end">
        <div class="col-md-3 "><!-- TOTAL -->
            <label for="cantidad" class="form-label label-custom">TOTAL($):</label>
            <input type="number" class="form-control form-input" id="total" name="total" disabled required>
        </div>
    </div>

    <!-- --------------------Boton agregar servicio y enviar cotizacion-------- -->
    <div class="container mt-5 d-flex justify-content-center align-items-center gap-2">
        <center><button type="button" id="addService" class="btn btn-primary btn-custom text-center">Agregar Servicio</button></center>
        <?php
              //Se asigna boton para generar cotizacion
              $btn="
                      <center><button type='button' id='genCotizacion' class='btn btn-primary btn-custom text-center' onclick=\"{$functionParameters}\">Revisar cotización</button></center>
              ";echo $btn;
        ?>
    </div>

    </div>
  </form>
</div>

<div class="d-flex justify-content-center align-items-center flex-column principalCustom" id="principal"></div>

<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <center> <div class="loader"></div></center>
                <center><h2>Procesando...</h2></center>
            </div>
        </div>
    </div>
</div>


<script>
    let a=0

    function addService(){
      if(a==0){
        $('#containerServices2').show()
        $('#service2').attr('required', 'required');
      }

      else if(a==1){
        $('#containerServices3').show()
        $('#service3').attr('required', 'required');
      }

      else{
        alert("Por el momento no se pueden agregar mas partidas, consulte al administrador")
      }

      a+=1
    }

    $(document).ready(function() {

        $('#containerServices2').hide()
        $('#containerServices3').hide()
        $('#addService').click(addService);
        $('#costo1').val(0)
        $('#costo2').val(0)
        $('#costo3').val(0)

        //----------- FUNCIONES CHANGE PARA PRIMERA PARTIDA DE COTIZACION -------------
        //Funcion que se ejecuta cuando se selecciona y cambia el tipo de servicio
        $("#typeService1").change(()=>{
            $('#cantidad1').val("")
            $('#cantidad1').prop('disabled', true);
            $('#numPersonaContainer1').show()
            if(($('#typeService1').val()=="RENTA DE PATIN") || ($('#typeService1').val()=="PERSONA ADICIONAL") || ($('#typeService1').val()=="MAQUILA") || ($('#typeService1').val()=="MAQUILA ESPECIALIZADA")){
                $('#numPersonaContainer1').hide()
            }
            $.ajax({
                url: 'newPriceProcess.php',
                type: 'POST',
                dataType: 'json',
                data: 
                {
                    typeService:$('#typeService1').val()
                },
                success: function(result)
                {
                    console.log(result)

                    $('#service1').empty();
                    $('#costo1').prop('disabled', true);
                    $('#costo1').val("")
                    $('#numPersona1').val("")
                    let nuevaOpcion = $('<option>',{value:"",text:"Seleccione servicio:"}).prop({selected: true, disabled: true});
                    $('#service1').append(nuevaOpcion);

                    for (let i = 0; i <= result.length-1; i++) {
                        nuevaOpcion = $('<option>', {
                            value: result[i].nombre,
                            text: result[i].nombre
                        });
                        $('#service1').append(nuevaOpcion);
                    }
                }
            });
        })

        //Funcion que se ejecuta cuando se selecciona y cambia el servicio
        $("#service1").change(()=>{
            $('#cantidad1').val(1)
            $('#cantidad1').prop('disabled', false);

            $.ajax({
                url: 'newPriceProcess.php',
                type: 'POST',
                dataType: 'json',
                data: 
                {
                    typeService:$('#typeService1').val(),
                    service:$('#service1').val()
                },
                success: function(result)
                {
                    console.log(result)
                    $('#costo1').prop('disabled', false);
                    $('#costo1').val((result.costo)*$('#cantidad1').val())   
                    $('#numPersona1').val(result.numPersonas)
                    $('#total').val(parseInt($('#costo1').val())+parseInt($('#costo2').val())+parseInt($('#costo3').val()))
                },
            });
        })

        //Funcion que se ejecuta cuando se cambia la cantidad del servicio seleccionado 
        $("#cantidad1").change(()=>{
            $.ajax({
                url: 'newPriceProcess.php',
                type: 'POST',
                dataType: 'json',
                data: 
                {
                    typeService:$('#typeService1').val(),
                    service:$('#service1').val()
                },
                success: function(result)
                {
                    console.log(result)
                    $('#costo1').val( $("#cantidad1").val()*result.costo) 
                    $('#numPersona1').val(result.numPersonas*$("#cantidad1").val())
                    $('#total').val(parseInt($('#costo1').val())+parseInt($('#costo2').val())+parseInt($('#costo3').val()))
                },
            });
        })

        //Funcion que se ejecuta cuando se cambia el costo del servicio seleccionado 
        $("#costo1").change(()=>{
            $('#total').val(parseInt($('#costo1').val())+parseInt($('#costo2').val())+parseInt($('#costo3').val()))
        })
        //------------------------------------------------------------------------------------------

         //----------- FUNCIONES CHANGE PARA SEGUNDA PARTIDA DE COTIZACION -------------
         //Funcion que se ejecuta cuando se selecciona y cambia el tipo de servicio
         $("#typeService2").change(()=>{
            $('#cantidad2').val("")
            $('#cantidad2').prop('disabled', true);
            $('#numPersonaContainer2').show()
            if(($('#typeService2').val()=="RENTA DE PATIN") || ($('#typeService2').val()=="PERSONA ADICIONAL") || ($('#typeService2').val()=="MAQUILA") || ($('#typeService2').val()=="MAQUILA ESPECIALIZADA")){
                $('#numPersonaContainer2').hide()
            }
            $.ajax({
                url: 'newPriceProcess.php',
                type: 'POST',
                dataType: 'json',
                data: 
                {
                    typeService:$('#typeService2').val()
                },
                success: function(result)
                {
                    console.log(result)

                    $('#service2').empty();
                    $('#costo2').prop('disabled', true);
                    $('#costo2').val("")
                    $('#numPersona2').val("")
                    let nuevaOpcion = $('<option>',{value:"",text:"Seleccione servicio:"}).prop({selected: true, disabled: true});
                    $('#service2').append(nuevaOpcion);

                    for (let i = 0; i <= result.length-1; i++) {
                        nuevaOpcion = $('<option>', {
                            value: result[i].nombre,
                            text: result[i].nombre
                        });
                        $('#service2').append(nuevaOpcion);
                    }
                }
            });
        })

        //Funcion que se ejecuta cuando se selecciona y cambia el servicio
        $("#service2").change(()=>{
            $('#cantidad2').val(1)
            $('#cantidad2').prop('disabled', false);

            $.ajax({
                url: 'newPriceProcess.php',
                type: 'POST',
                dataType: 'json',
                data: 
                {
                    typeService:$('#typeService2').val(),
                    service:$('#service2').val()
                },
                success: function(result)
                {
                    console.log(result)
                    $('#costo2').prop('disabled', false);
                    $('#costo2').val((result.costo)*$('#cantidad2').val())   
                    $('#numPersona2').val(result.numPersonas)   
                    $('#total').val(parseInt($('#costo1').val())+parseInt($('#costo2').val())+parseInt($('#costo3').val()))
                },
            });
        })

         //Funcion que se ejecuta cuando se cambia la cantidad del servicio seleccionado 
         $("#cantidad2").change(()=>{
            $.ajax({
                url: 'newPriceProcess.php',
                type: 'POST',
                dataType: 'json',
                data: 
                {
                    typeService:$('#typeService2').val(),
                    service:$('#service2').val()
                },
                success: function(result)
                {
                    console.log(result)
                    $('#costo2').val( $("#cantidad2").val()*result.costo) 
                    $('#numPersona2').val(result.numPersonas*$("#cantidad2").val())
                    $('#total').val(parseInt($('#costo1').val())+parseInt($('#costo2').val())+parseInt($('#costo3').val()))
                },
            });
        })

        //Funcion que se ejecuta cuando se cambia el costo del servicio seleccionado 
        $("#costo2").change(()=>{
            $('#total').val(parseInt($('#costo1').val())+parseInt($('#costo2').val())+parseInt($('#costo3').val()))
        })

         //----------- FUNCIONES CHANGE PARA TERCERA PARTIDA DE COTIZACION -------------
         //Funcion que se ejecuta cuando se selecciona y cambia el tipo de servicio
         $("#typeService3").change(()=>{
            $('#cantidad3').val("")
            $('#cantidad3').prop('disabled', true);
            $('#numPersonaContainer3').show()
            if(($('#typeService3').val()=="RENTA DE PATIN") || ($('#typeService3').val()=="PERSONA ADICIONAL") || ($('#typeService3').val()=="MAQUILA") || ($('#typeService3').val()=="MAQUILA ESPECIALIZADA")){
                $('#numPersonaContainer3').hide()
            }
            $.ajax({
                url: 'newPriceProcess.php',
                type: 'POST',
                dataType: 'json',
                data: 
                {
                    typeService:$('#typeService3').val()
                },
                success: function(result)
                {
                    console.log(result)

                    $('#service3').empty();
                    $('#costo3').prop('disabled', true);
                    $('#costo3').val("")
                    $('#numPersona3').val("")
                    let nuevaOpcion = $('<option>',{value:"",text:"Seleccione servicio:"}).prop({selected: true, disabled: true});
                    $('#service3').append(nuevaOpcion);

                    for (let i = 0; i <= result.length-1; i++) {
                        nuevaOpcion = $('<option>', {
                            value: result[i].nombre,
                            text: result[i].nombre
                        });
                        $('#service3').append(nuevaOpcion);
                    }
                }
            });
        })

        //Funcion que se ejecuta cuando se selecciona y cambia el servicio
        $("#service3").change(()=>{
            $('#cantidad3').val(1)
            $('#cantidad3').prop('disabled', false);

            $.ajax({
                url: 'newPriceProcess.php',
                type: 'POST',
                dataType: 'json',
                data: 
                {
                    typeService:$('#typeService3').val(),
                    service:$('#service3').val()
                },
                success: function(result)
                {
                    console.log(result)
                    $('#costo3').prop('disabled', false);
                    $('#costo3').val((result.costo)*$('#cantidad3').val())   
                    $('#numPersona3').val(result.numPersonas)   
                    $('#total').val(parseInt($('#costo1').val())+parseInt($('#costo2').val())+parseInt($('#costo3').val()))
                },
            });
        })

         //Funcion que se ejecuta cuando se cambia la cantidad del servicio seleccionado 
         $("#cantidad3").change(()=>{
            $.ajax({
                url: 'newPriceProcess.php',
                type: 'POST',
                dataType: 'json',
                data: 
                {
                    typeService:$('#typeService3').val(),
                    service:$('#service3').val()
                },
                success: function(result)
                {
                    console.log(result)
                    $('#costo3').val( $("#cantidad3").val()*result.costo) 
                    $('#numPersona3').val(result.numPersonas*$("#cantidad3").val())
                    $('#total').val(parseInt($('#costo1').val())+parseInt($('#costo2').val())+parseInt($('#costo3').val()))
                },
            });
        })

        //Funcion que se ejecuta cuando se cambia el costo del servicio seleccionado 
        $("#costo3").change(()=>{
            $('#total').val(parseInt($('#costo1').val())+parseInt($('#costo2').val())+parseInt($('#costo3').val()))
        })

    });

</script>
