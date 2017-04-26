@extends('layouts.app')
@section('content')
<html>
<head>
    <meta charset="UTF-8">
    <title>Compra</title>
    <!-- Latest compiled and minified CSS -->
    <link href="../sticky-footer.css" rel="stylesheet">
</head>
<body>

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Tienda de celulares</h1>
        <p>Regresar a productos <a href="{{ url('/tienda') }}">aquí</a></p>
            <table class="table table-bordered">
            <div class="row">
              <div class=" col-md-6">
                <div class="thumbnail">
                 <img class="img-responsive" src="../{{ $celular->image }}" alt="...">
                  <div class="caption">
                    <h3>{{ $celular->titulo }}</h3>
                    <p>${{ $celular->precio }}</p>
                    <p>{{ $celular->descripcion }}</p>
                    <p><button  id="miBoton" class="btn btn-primary"  data-target="#pagar">Pagar</button> </p>
                    Acepto los <a href="#">términos y condiciones </a><input type="checkbox" id="check"/>
                 
                  </div>
                </div>
              </div>
            </div>
            </table>
    
      </div>
      
<div class="modal draggable fade" id="pagar" tabindex="-1" role="dialog" aria-labelledby="Register" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Cerrar</span>
          </button>
          <h4 class="modal-title" id="titulomodal">Complete sus Datos</h4>
        </div>
        <div class="modal-body">
       <form class="form-horizontal" id="culqi-card-form" method="POST">
        {!! csrf_field() !!}
        <div class="form-group">
        <label for="email" class="col-sm-4 control-label"><span>Email:</span></label>          
          <div class="col-md-6">
            <input type="email" name="email" id="email" data-culqi="card[email]" class="form-control culqi-email">
            
          </div>
         </div> 
         <div class="form-group">
          <label for="number" class="col-sm-4 control-label"><span>Numero de Tarjeta:</span></label>          
          <div class="col-md-5">
            <input type="text" name="number" id="number" size="20" maxlength="20" data-culqi="card[number]" data-creditcard="true" class="form-control culqi-card">
          </div>
          </div>
          <div class="form-group">
          <label for="cvv" class="col-sm-4 control-label"><span>CVV:</span></label>          
          <div class="col-md-3">
            <input type="text" name="cvv" size="20" maxlength="4" data-culqi="card[cvv]" class="form-control culqi-cvv">
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-4 control-label"><span>Fecha Expiracion (MM/YYYY):</span></label>          
          <div class="col-sm-2">
            <input type="text" name="exp_month" size="2" maxlength="2" data-culqi="card[exp_month]" class="form-control culqi-expm">
          </div>
          <div class="col-md-3">
            <input type="text" name="exp_year" size="4" maxlength="4" data-culqi="card[exp_year]" class="form-control culqi-expy">
          </div>
          </div>
          <div class="form-group">
          <label for="direccion" class="col-sm-4 control-label"><span>Direccion:</span></label>          
          <div class="col-md-6">
              <input type="text" name="address" size="20" maxlength="150" data-culqi="card[address]" class="form-control">
          </div>
          </div>
          <div class="form-group">
              <label class="col-sm-4 control-label" for="id_departamento">Departamento:</label>
              <div class="col-sm-6">
                <div class="input-group">
                  <div class="input-group-addon">
                    <span class="fa fa-street-view"></span>
                  </div>
                  <select class="form-control id_departamento" name="address_city"  placeholder="Seleccione Departamento" required >
                    <option value="0">Seleccione un Departamento</option>
                    @foreach ($departamentos as $departamento)
                      <option value="{{$departamento->departamento}}">{{$departamento->departamento}}</option>
                    @endforeach 
                  </select>
                </div>
              </div>
            </div>  
            <div class="form-group">
          <label for="direccion" class="col-sm-4 control-label"><span>Telefono:</span></label>          
          <div class="col-md-6">
              <input type="text" name="phone_number" size="20" maxlength="15" data-culqi="card[phone_number]" class="form-control">
          </div>
          </div>
            <input type="hidden" name="monto" value="{{ $celular->precio }}">
          <div class="modal-footer">
            <input type="submit" class="btn btn-primary"  id="paga" value="Pagar">
            <input type=reset class="btn btn-info" value="Limpiar">   
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cerrar</button>
            </div>

        </form>

      </div>
   </div>
   </div>
   </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">Una implementación de Culqi en Laravel</p>
      </div>
    </footer>

</body>
</html>
@endsection
@section('extrajs')
<script>

        //$('.modal').modal({ keyboard: true,show: false,});
        // Jquery draggable
        /*
        $('.modal-dialog').draggable({
          handle: ".modal-header"
        });*/

        //  Culqi.codigoComercio = '4s4cv6LfyqNI'; //El parametro para usar con la api antigua.
        Culqi.publicKey = 'pk_test_LAsdiu7J6WGRMlL6';
        Culqi.useClasses= true;
        Culqi.init();
        Culqi.settings({
            title: '{{$celular->titulo}}', 
            orden: '{{$celular->id}}', 
            currency: 'PEN',
            description: '{{$celular->descripcion}}',
            amount: {{$celular->precio*100}}
        });
        
         $('#miBoton').on('click', function (e) { //Función para mostrar el modal de culqi con el formularrio
            
            if($("#check").is(':checked')){
                // Abre el formulario con las opciones de Culqi.configurar
                $('.modal').modal({ keyboard: true,show: true,});
              // Jquery draggable
                $('.modal-dialog').draggable({
                  handle: ".modal-header"
                });
                //Culqi.open();
                }else{
                    swal('Acepta los terminos y Condiciones.','','error')
                }
            });
        $("#paga").click(function(e){
            var culqiForm=$("#culqi-card-form").serialize();
            $(".error-message").remove();
            e.preventDefault();
            $.post("/regpago", culqiForm,function(data){
                  if(data.result=="success"){ 
                    Culqi.createToken();
                    //$('.modal').modal('hide');
                  }
            });
         });  
        
       
    </script>
    <script>  
    // Ejemplo: Tratando respuesta con AJAX (jQuery)
    function culqi() {
        console.log('Ejecuto la funcion culqui.');
        if(Culqi.error){
           // Mostramos JSON de objeto error en consola
           console.log(Culqi.error);
           alert(Culqi.error.mensaje);
        }else{ 
           console.log(Culqi.token.id);
           $.post("../tarjeta", // Ruta hacia donde enviaremos el token vía POST
            {token: Culqi.token.id, id_producto:{{$celular->id}},email:Culqi.token.email,installments: Culqi.token.metadata.installments, address:$("input[name='address']").val(), address_city:$("select[name='address_city']").val(),phone_number:$("input[name='phone_number']").val()},
            function(data, status){
                console.log(data);
                //data=JSON.parse(data); //convertir data json a objeto js
              if(data=="ok"){
                    //alert("Cargo realizado exitosamente");
                     swal({
                      title:'Cargo realizado exitosamente',
                      text:'Click en Aceptar',
                      type:'success'
                     }).then(function() {
                      window.location="{{url('/tienda')}}"
                     });
                      
                }else{
                   //alert("Error");
                   swal('Error','Algo no anda bien','error')
                   // console.log(data);
                   // alert(data.mensaje_usuario);
                }
            });
           }
    };
    </script>  
    <script>
        $("#culqi-card-form").formValidation({
          framework: 'bootstrap',
          icon:{
              valid: 'glyphicon glyphicon-ok',
              invalid: 'glyphicon glyphicon-remove',
              validating: 'glyphicon glyphicon-refresh'
          },
          fields:{
          email:{
            validators:{
                notEmpty: {
                        message: 'Correo es requerido'
                    },
                message:'El correo es inválido'
              }
            
          },
            number:{
              validators:{
                notEmpty:{
                  message:'El numero de tarjeta es requerido'
                },
                creditCard:{
                  message:'El numero de la tarjeta es inválido'
                }
              }
            },
            cvv:{
              validators:{
                cvv:{
                  message:'El numero de cvv es inválido'
                }
              }
            },
            exp_month:{
             row: '.col-xs-3',
             validators: {
                    notEmpty: {
                        message: 'Mes de expiracion requerido'
                    },
                    digits: {
                        message: 'El mes de expiracion puede contener solo digitos'
                    },
                    callback: {
                        message: 'Expiró',
                        callback: function(value, validator, $field) {
                            value = parseInt(value, 10);
                            var year         = validator.getFieldElements('exp_year').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < 0 || value > 12) {
                                return false;
                            }
                            if (year == '') {
                                return true;
                            }
                            year = parseInt(year, 10);
                            if (year > currentYear || (year == currentYear && value >= currentMonth)) {
                                validator.updateStatus('exp_year', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
            exp_year:{
             row: '.col-xs-3',
             validators: {
                    notEmpty: {
                        message: 'El año de expiracion es requerido'
                    },
                    digits: {
                        message: 'El año de expiracion solo puede contener digitos'
                    },
                    callback: {
                        message: 'Expiró',
                        callback: function(value, validator, $field) {
                            value = parseInt(value, 10);
                            var month        = validator.getFieldElements('exp_month').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < currentYear || value > currentYear + 10) {
                                return false;
                            }
                            if (month == '') {
                                return false;
                            }
                            month = parseInt(month, 10);
                            if (value > currentYear || (value == currentYear && month >= currentMonth)) {
                                validator.updateStatus('exp_month', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            
            }
          }
        }).on('success.validator.fv', function(e,data){
            if(data.field === 'number' && data.validator === 'creditCard'){
              var $icon = data.element.data('fv.icon');
              
              switch (data.result.type){
                case 'AMERICAN_EXPRESS':
                    $icon.removeClass().addClass('form-control-feedback fa fa-cc-amex');
                        break;
                
                case 'DISCOVER':
                    $icon.removeClass().addClass('form-control-feedback fa fa-cc-discover');
                        break;
                
                 case 'MASTERCARD':
                 case 'DINERS_CLUB_US':
                        $icon.removeClass().addClass('form-control-feedback fa fa-cc-mastercard');
                        break;
                 case 'VISA':
                        $icon.removeClass().addClass('form-control-feedback fa fa-cc-visa');
                        break;

                 default:
                        $icon.removeClass().addClass('form-control-feedback fa fa-credit-card');
                        break;       
                }
              }
            }).on('err.field.fv', function(e, data) {
            if (data.field === 'number') {
                var $icon = data.element.data('fv.icon');
                $icon.removeClass().addClass('form-control-feedback fa fa-times');
            }
        });
                 
    </script>
@endsection

