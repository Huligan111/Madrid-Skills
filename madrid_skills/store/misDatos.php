<div class="col-md-8 order-md-1">
    <h4 class="mb-3">Dirección de facturación</h4>
    <form id="registroCliente" class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="firstName">Nombre</label>
            <input type="text" class="form-control" id="firstName" required name="nombre">
            <div class="invalid-feedback">Se requiere un nombre válido.</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="lastName">Apellido</label>
            <input type="text" class="form-control" id="lastName" required name="apellidos">
            <div class="invalid-feedback">Se requiere un apellido válido.</div>
        </div>
    </div>

    <div class="mb-3">
        <label for="username">Nombre de usuario</label>
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text">@</span></div>
            <input type="text" class="form-control" id="username" required name="usuario">
            <div class="invalid-feedback" style="width: 100%;">Se requiere el nombre de usuario.</div>
        </div>
    </div>

    <div class="mb-3">
        <label for="email">Email <span class="text-muted">(Opcional)</span></label>
        <input type="email" class="form-control" id="email" placeholder="ejemplo@mail.com" readonly name="email">
        <div class="invalid-feedback">Introduzca una dirección de email válida para recibir actualizaciones.</div>
    </div>

    <div class="mb-3">
        <label for="address">Dirección</label>
        <input type="text" class="form-control" id="address" required name="direccion">
        <div class="invalid-feedback">Introduzca su dirección de envío.</div>
    </div>

    <div class="mb-3">
        <label for="telefono">Teléfono <span class="text-muted">(Opcional)</span></label>
        <input type="text" class="form-control" id="telefono" name="telefono">
    </div>

    <div class="row">
        <div class="col-md-5 mb-3">
            <!-- <label for="country">País</label> 
            <select class="custom-select d-block w-100" id="country" required>
                <option value="">Elegir...</option>
                <option>España</option>
            </select>
            <div class="invalid-feedback">Seleccione un país.</div>-->
            <label for="date">Fecha nacimiento <span class="text-muted">(Opcional)</span></label>
            <input type="date" class="form-control" id="date" name="fechaNacimiento">
        </div>
        <div class="col-md-4 mb-3">
            <label for="tipo">Tipo identificador</label>
            <select class="custom-select d-block w-100" id="tipo" required name="tipoIdentificador">
                <option value="">Elegir...</option>
                <option>DNI</option>
                <option>NIE</option>
                <option>PASAPORTE</option>
            </select>
            <div class="invalid-feedback">Selecciona una provincia.</div>
        </div>
        <div class="col-md-3 mb-3">
            <label for="identificador">Identificador</label>
            <input type="text" class="form-control" id="identificador" required name="identificador">
            <div class="invalid-feedback">Se requiere un identificador.</div>
        </div>
    </div>
    <hr class="mb-4">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="same-address">
        <label class="custom-control-label" for="same-address">La dirección de envío es la misma que la de facturación.</label>
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="save-info">
        <label class="custom-control-label" for="save-info">Guardar esta información para la próxima vez.</label>
    </div>
    <hr class="mb-4">

    <h4 class="mb-3">Pago</h4>

    <div class="d-block my-3">
        <div class="custom-control custom-radio">
            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
            <label class="custom-control-label" for="credit">Tarjeta de crédito</label>
        </div>
        <div class="custom-control custom-radio">
            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="debit">Tarjeta de débito</label>
        </div>
        <div class="custom-control custom-radio">
            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="paypal">PayPal</label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="cc-name">Nombre del titular</label>
            <input type="text" class="form-control" id="cc-name" required>
            <small class="text-muted">Nombre y apellidos que figuran en la tarjeta</small>
            <div class="invalid-feedback">Se requiere el nombre del titular de la tarjeta.</div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="cc-number">Número de tarjeta</label>
            <input type="text" class="form-control" id="cc-number" required>
            <div class="invalid-feedback">Se requiere el número de la tarjeta.</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="cc-expiration">Expiración</label>
            <input type="text" class="form-control" id="cc-expiration" required>
            <div class="invalid-feedback">Se requiere fecha de expiración de tarjeta</div>
        </div>
        <div class="col-md-3 mb-3">
            <label for="cc-cvv">CVV</label>
            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
            <div class="invalid-feedback">Se requiere el código de seguridad de la tarjeta.</div>
        </div>
    </div>
    <hr class="mb-4">
    <button class="btn btn-primary btn-lg btn-block" type="submit" onclick="this.disabled=true;";>Guardar datos</button>
    </form>
    
</div>

<script>
    //Este código se ejecuta al cargarse el archivo
    document.addEventListener("DOMContentLoaded", function() {
        //Recuperamos del sesión storage el email del usuario que ingreso en login_form.php
         let email = document.getElementById('email');
         email.value = sessionStorage.getItem('emailUsuario'); //Ponemos el email en el campo email del usuario
        });


        //Ponemos un escuchador de evento submit al formulario para ingresar los datos en BD
        const formulario = document.getElementById('registroCliente'); 
        formulario.addEventListener('submit', insertar);
        
        //Esta función inserta con el método POST los datos de los formularios
        function insertar(e) {
            e.preventDefault(); //Prevenimos el comportamiento por defecto (el refrescado de la pagina)
            //console.log("Evento detectado");
            
            //Creamos un objeto de FormData que almacena los datos del formulario
            let datos = new FormData(e.target); //e.target es todo el formulario
            //Creamos un objeto anónimo que contiene el método y los datos que se envían
            let peticion = {
                method: "POST",
                body: datos
            };
            //console.log(datos);
            
            //Creamos una promesa y enviamos los datos a este archivo
            fetch("../controlador-api/api-cliente/cliente-api.php", peticion)
                .then((res) => res.json()) //esperamos la respuesta en formato json (en el php hay que poner    echo json_encode('mensaje o datos para recibir'))
                .then((data) => {

                    console.log("Data "+data);

                })
                .catch((error) => console.log("error", error));
                
        }
</script>