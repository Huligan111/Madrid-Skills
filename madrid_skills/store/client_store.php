<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Gaspar Hernandez Cebrian">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"><!-- link bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"><!-- link iconos bootstrap -->
    <title>Ecomerce</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand me-5" href="client_store.php"> <!-- ICONO LOGO APP -->
                <img src="../icon/App/icon_100px.png" class="me-5">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span><!-- BOTÓN MENÚ PARA VERSIONES MÓVIL -->
            </button>
            <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
                <ul class="navbar-nav me-5 mb-2 mb-lg-0">
                    <li class="nav-item"><!-- BARRA DE BÚSQUEDA -->
                        <form class="d-flex ms-5 me-5">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </form>
                    </li>
                    <li class="nav-item dropdown ms-5 me-5"><!-- MENÚ DESPLEGABLE USUARIO -->
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Usuario<i class="bi bi-person-fill-gear"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown"><!-- OPCIONES MENÚ USUARIO -->
                                <li><a class="dropdown-item" href="client_store.php?id_action=1" id="misDatos">Mis datos</a></li>
                                <li><a class="dropdown-item" href="client_store.php?id_action=2">Mis pedidos</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="public_store.php" id="cerrarSession">Cerrar sesión</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-5 me-5"><!-- BOTÓN PEDIDOS -->
                        <a class="nav-link active" href="client_store.php?id_action=2">Pedidos</a>
                    </li>
                    <li class="nav-item ms-5"><!-- BOTÓN CARRITO -->
                        <a class="nav-link active" href="client_store.php?id_action=5">
                            <i class="bi bi-cart3"><strong id="contadorCarrito"></strong></i><!-- ICONO CARRITO -->
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="workArea" class="container-fluid  rounded mt-5 w-75 p-5 border d-flex flex-col">

        <?php if (!empty($_GET['id_action']) && $_GET['id_action'] == 1) : ?>
            <?php
            include_once('misDatos.php');
            ?>
        <?php endif ?>
        <?php if (!empty($_GET['id_action']) && $_GET['id_action'] == 2) : ?>
            <?php
            include_once('pedidos.php');
            ?>
        <?php endif ?>
        <?php if (!empty($_GET['id_action']) && $_GET['id_action'] == 5) : ?>
            <?php
            include_once('carrito.php');

            ?>
        <?php endif ?>
        <?php if (empty($_GET['id_action'])) : ?>
            <div class="card col-2">
                <img src="../icon/Product/Product_256px.png" class="card-img-top" />
                <div class="card-body">
                    <h5 class="card-title">Nombre</h5>
                    <p class="card-text">Categoría</p>
                    <p class="card-text">21€</p>
                    <p class="card-text text-success fs-6">Disponible</p>
                    <a href="#!" class="btn btn-primary">Añadir</a>
                </div>
            </div>
        <?php endif ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.onload = mostrarProductos; //Cuando se carga la pagina principal se ejecuta esta función que muestra todas las tarjetas con todos los productos

        let objetos; //Esta variable va a almacenar todos los datos de la BD cuando se reciben de la función de abajo para después usarlos con el carrito y no tener que hacer otra consulta
        //Esta función muestra los productos en la pagina principal (las tarjetas)
        function mostrarProductos() {
            // Verificamos si la función ya se ha ejecutado previamente (asi podemos abrir las paginas de mis datos y mis pedidos, termina al final)
            if (!sessionStorage.getItem('funcionEjecutada')) {
                //Aquí va el código de la función que se ejecutará solo la primera vez

                //Llamamos el controler pasando por url (el método GET) el parámetro por cual filtrar cuando llega a php
                const url = `../controlador-api/api-producto/producto-api.php?nombre=productos`; //Esta es la ruta que acede a la api

                // realizar una solicitud GET con fetch
                fetch(url)
                    .then((response) => response.json())
                    .then((data) => {
                        objetos = data; //después estos objetos en la función aniadirCarito()
                        let tarjetas = ""; //esta variable almacenara todos las tarjetas
                        const contenedor = document.getElementById("workArea"); //obtenemos el div donde se van a poner todas las tarjetas
                        //console.log("Objetos: "+objetos);

                        //recorremos todos los productos que nos devuelve el api y creamos tarjetas con cada uno (cada vuelta una tarjeta)
                        for (let i = 0; i < data.length; i++) {
                            console.log(data[i]);

                            tarjetas += `<div class="card col-2 m-1">
                                        <img src="../icon/Product/Product_256px.png" class="card-img-top"/>
                                        <div class="card-body">
                                            <h5 class="card-title">Nombre: ${data[i].nombre}</h5>
                                            <p class="card-text">Categoría: ${data[i].categoria}</p>
                                            <p class="card-text">Precio: ${data[i].precio} €</p>
                                            <p class="card-text text-success fs-6">Stock: ${data[i].unidadesStock} </p>
                                            <a href="#!" id="${data[i].id}" class="btn btn-primary carrito">Añadir</a>
                                        </div>
                                     </div>`;

                        }
                        contenedor.innerHTML = tarjetas; //pintamos todas las tarjetas sobre el html
                        //Añadamos botón de escucha a cada elemento para después añadirlo al carrito al pulsarlo
                        const botones = document.querySelectorAll(".carrito"); //obtenemos todos los botones de las tarjetas recién creadas para poner su botón en escucha
                        botones.forEach(boton => {
                            boton.addEventListener("click", aniadirCarrito);
                        });

                    })
                    .catch((error) => console.error(error));

                // Guardamos un valor en sessionStorage para indicar que la función ya se ha ejecutado
                sessionStorage.setItem('funcionEjecutada', true);
            }
        }

        //Esta parte es para el carrito (almacena los datos de los productos que se han almacenado)
        let productosSeleccionados = []; //En este array se almacenan todos los productos que selecciona el cliente con el boton Añadir al carrito
        let acumulador = 1; //Este acumulador es para mostrar cuantas veces se ha pulsado el boton Añadir al carrito
        const contadorCarito = document.getElementById("contadorCarrito"); //obtenemos el boton cesta del menu en la pagina principal 
        //Esta función es para almacenar los productos que ha seleccionado el usuario (los que añade en el carrito)
        function aniadirCarrito(e) {
            console.log(e.target.id);
            contadorCarito.textContent = acumulador++; //cada vez que se pulsa algún boton de añadir al carrito incrementamos y mostramos el contador en el menu en la pagina principal
            productosSeleccionados.push(objetos.find((objeto) => objeto.id == e.target.id)); //Añadimos el producto que coincide con el id del boton que se ha pulsado
            console.log(productosSeleccionados);
            //Almacenamos todos los productos en la memoria del navegador para recuperarlos (utilizarlos) en carrito_cliente.view.php
            sessionStorage.setItem("productosSeleccionados", JSON.stringify(productosSeleccionados)); //convertimos el array de objetos en string para poder almacenarlos en la memoria del navegador
        }


        //Detectar si el usuario quiere salir de al session (si quiere borramos su email de sessionStorage)
        let cerrarSession = document.getElementById('cerrarSession');
        cerrarSession.addEventListener('click', ()=>{
            sessionStorage.removeItem('funcionEjecutada');
            sessionStorage.removeItem('emailUsuario');
        });
     
            

    </script>

</body>
</html>