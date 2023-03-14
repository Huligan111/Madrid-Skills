<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Gaspar Hernandez Cebrian">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"><!-- link bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"><!-- link iconos bootstrap -->
    <title>SignIn form</title>
</head>
<body>
    <div id="workArea" class="container-fluid mt-3" style="width: 30%;">
        <div class="mb-3 d-flex justify-content-center">
            <img src="../icon/App/icon_100px.png">
        </div>      
        <form class="border rounded p-3 m-3">
            <h2 class="">Iniciar sesión</h2>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="passwd" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="passwd" name="clave">
                <input type="text" class="form-control" id="id" name="loginCliente" hidden>
            </div>
            <button type="submit" class="btn btn-primary w-100">Continuar</button>
            <div>
                <p class="mt-3" style="font-size:smaller">
                    Al identificarte aceptas nuestras <a class="text-decoration-none" href="">Condiciones de uso y venta</a>. 
                    Consulta nuestro <a class="text-decoration-none" href="">Aviso de privacidad</a>, 
                    nuestro <a class="text-decoration-none" href="">Aviso de Cookies</a> 
                    y nuestro <a class="text-decoration-none" href="">Aviso sobre publicidad basada en los intereses del usuario</a>.
                </p>
            </div>
        </form>
        <div class="d-flex row m-3">
            <p class="align-self w-100" style=" text-align:center">¿Eres nuevo en Ecommerce.com?</p>
            <a class="btn btn-primary w-100" href="signin_form.php">Crea tu cuenta de Ecommerce.com</a>
        </div>
        <hr>    
    </div>
    <footer class="text-center">
    <div class="text-center p-3">
        <a class="me-5 text-decoration-none" href="">Condiciones de uso</a>
        <a class="me-5 text-decoration-none" href="">Aviso de privacidad</a>
        <a class="me-5 text-decoration-none" href="">Ayuda</a>
        <a class="me-5 text-decoration-none" href="">Cookies</a>
        <p>© 1988-2023, Ecommerce.com, Inc. o sus afiliados.</p>
    </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        //LOGIN DEL CLIENTE
        //Ponemos un escuchador de evento submit al formulario
        //const formulario = document.forms[0]; 
        //console.log(formulario);
        document.forms[0].addEventListener('submit', ingresar);

        
        //Esta función inserta con el método POST los datos de los formularios
        function ingresar(e) {
            e.preventDefault(); //Prevenimos el comportamiento por defecto (el refrescado de la pagina)
            //console.log("Evento detectado");
            
            //Creamos un objeto de FormData que almacena los datos del formulario
            let datos = new FormData(e.target); //e.target es todo el formulario
            //Creamos un objeto anónimo que contiene el método y los datos que se envían
            let peticion = {
                method: "POST",
                body: datos
            };
            console.log(datos);

            //Creamos una promesa y enviamos los datos a este archivo
            fetch("../controlador-api/api-cliente/cliente-api.php", peticion)
                .then((res) => res.json()) //esperamos la respuesta en formato json (en el php hay que poner    echo json_encode('mensaje o datos para recibir'))
                .then((data) => {    
                    //console.log("Data "+data);
                    //Comprobamos si los datos son correctos 
                    if(data == "CLIENTE VALIDO"){
                        //Abrimos session al usuario 
                        const email = document.getElementById("email").value; //Obtenemos el email ingresado para nosotros esto es el usuario
                        sessionStorage.setItem('emailUsuario', email);
                        location.href = "../store/client_store.php"; //Redirigimos a la pagina del login
                    }else{
                        console.log(data); //Si el cliente no es valido muestra por consola
                    }
                    
                    //data es la respuesta que devuelve el php con   echo json_encode('datos de retorno');
                    //Comprobamos si lo que nos devuelve php es la ruta que nos redirection o es un mensaje
                   // if (data.substring(0, 5) === "index") { //si comienza con index es una ruta 
                   //     location.href = data;
                   // } else { //si no comienza con index es un mensaje 
                   //     //Creamos un elemento div para mostrar un alert con el mensaje que retorna el php
                   //     const mensaje = document.createElement("div");
                   //     mensaje.setAttribute("class", "alert alert-success"); //añadimos las clases de bootstrap necesarias
                   //     mensaje.setAttribute("role", "alert"); //añadimos el atributo role con valor alert
                   //     mensaje.textContent = data; //insertamos los datos obtenidos del php (es un mensaje)
                   //     e.target.appendChild(mensaje); //añadimos al final del formulario el alert
                   // }
                    
                })
                .catch((error) => console.log("error", error));
        }
    </script>
</body>
</html>