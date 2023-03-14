<?php
    //incorporación fichero contiene el código para obtener los productos de la BD.
    //include_once("get_productos.php");
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
    <title>Ecomerce</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light"><!-- MENÚ NAVEGACIÓN-->
        <div class="container-fluid">
            <a class="navbar-brand me-5" href="public_store.php"> <!-- ICONO LOGO APP -->
                <img src="../icon/App/icon_100px.png" class="me-5">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><!-- BOTÓN MENÚ PARA VERSIONES MÓVIL -->
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
                <ul class="navbar-nav me-5 mb-2 mb-lg-0">
                    <li class="nav-item"><!-- BARRA DE BÚSQUEDA -->
                        <form class="d-flex ms-5">
                            <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </form>
                    </li>
                </ul>
            </div>
            <a class="nav-link active" href="../login/login_form.php"><!-- BOTÓN LOGIN -->
                Autenticación
                <i class="bi bi-person-check-fill"></i>
            </a>
            <a class="nav-link active ms-5" href="../login/signin_form.php"><!-- BOTÓN SIGIN  -->
                Registro
                <i class="bi bi-person-lines-fill"></i>
            </a>
        </div>
    </nav>

    <!-- Contenedor tarjetas -->
    <div id="workArea" class="container-fluid rounded mt-5 w-75 p-3 border d-flex flex-col ">
        <div class="card col-2">
            <img src="../icon/Product/Product_256px.png" class="card-img-top"/>
            <div class="card-body">
                <h5 class="card-title">Nombre</h5>
                <p class="card-text">Categoría</p>
                <p class="card-text">21€</p>
                <p class="card-text text-success fs-6">Disponible</p>
                <a href="#!" class="btn btn-primary">Añadir</a>
            </div>
        </div>     
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.onload = mostrarProductos; //Cuando se carga la pagina principal se ejecuta esta función que muestra todas las tarjetas con todos los productos
        let objetos;
        //Esta función muestra los productos en la pagina principal (las tarjetas)
        function mostrarProductos() {
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

                    //recorremos todos los productos que nos devuelve el php y creamos tarjetas con cada uno (cada vuelta una tarjeta)
                    for (let i = 0; i < data.length; i++) {
                        console.log(data[i]);

                        tarjetas += `<div class="card col-2 m-2">
                                        <img src="../icon/Product/Product_256px.png" class="card-img-top"/>
                                        <div class="card-body">
                                            <h5 class="card-title">Nombre: ${data[i].nombre}</h5>
                                            <p class="card-text">Categoría: ${data[i].categoria}</p>
                                            <p class="card-text">Precio: ${data[i].precio} €</p>
                                            <p class="card-text text-success fs-6">Stock: ${data[i].unidadesStock} </p>
                                            <a href="#!" class="btn btn-primary">Añadir</a>
                                        </div>
                                     </div>`;

                    }
                    contenedor.innerHTML = tarjetas; //pintamos todas las tarjetas sobre el html
                    const botones = document.querySelectorAll(".btn"); //obtenemos todos los botones de las tarjetas recién creadas para poner su botón en escucha
                    botones.forEach(boton => {
                        boton.addEventListener("click", aniadirCarito);
                    });

                })
                .catch((error) => console.error(error));
        }

    </script>
</body>
</html>