<section class="h-100" style="background-color: #eee;">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-11">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0 text-black">Pedidos</h3>
                </div>

                <div class="card rounded-3 mb-4">
                    <div id="contenedor" class="card-body p-1">
                        <div class="col d-flex justify-content-between align-items-center">
                            <div class="col-2"><!-- Div que muestra la imagen del pedido -->
                                <img src="../icon/Packing/Packing_64px.png" class="img-fluid rounded-3">
                            </div>
                            <div class="col-2"><!-- Div muestra el número del pedido -->
                                <p class="lead fw-normal mb-2">Pedido nº: </p>
                            </div>
                            <div class="col-2"><!-- Div muestra la fecha del pedido -->
                                <p class="lead fw-normal mb-2">Fecha: </p>
                            </div>
                            <div class="col-2"><!-- Div muestra el estado del pedido -->
                                <p class="lead fw-normal mb-2">Estado: </p>
                            </div>
                            <div class="col-2"><!-- Div muestra el importe del pedido-->
                                <h5 class="mb-0">Total: €</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
        window.onload = mostrarPedidos; //Cuando se carga la pagina principal se ejecuta esta función que muestra todas las tarjetas con todos los datos de los pedidos

        let objetos; //Esta variable va a almacenar todos los datos de la BD cuando se reciben de la función de abajo para después usarlos con el carrito y no tener que hacer otra consulta
        //Esta función muestra los productos en la pagina principal (las tarjetas)
        function mostrarPedidos() {

                //Llamamos el controler pasando por url (el método GET) el parámetro por cual filtrar cuando llega a php
                const url = `../controlador-api/api-pedido/pedido-api.php?email=${sessionStorage.getItem("emailUsuario")}`; //Esta es la ruta que acede a la api

                // realizar una solicitud GET con fetch
                fetch(url)
                    .then((response) => response.json())
                    .then((data) => {
                        //objetos = data; //después estos objetos en la función aniadirCarito()
                        //console.log(data);
                        let tarjetas = ""; //esta variable almacenara todos las tarjetas
                        const contenedor = document.getElementById("contenedor"); //obtenemos el div donde se van a poner todas las tarjetas
                        //console.log("Objetos: "+objetos);

                        //recorremos todos los productos que nos devuelve el api y creamos tarjetas con cada uno (cada vuelta una tarjeta)
                        for (let i = 0; i < data.length; i++) {

                            tarjetas += `<div class="col d-flex justify-content-between align-items-center">
                                            <div class="col-2"><!-- Div que muestra la imagen del pedido -->
                                                <img src="../icon/Packing/Packing_64px.png" class="img-fluid rounded-3">
                                            </div>
                                            <div class="col-2"><!-- Div muestra el número del pedido -->
                                                <p class="lead fw-normal mb-2">Pedido nº: ${data[i]['id']}</p>
                                            </div>
                                            <div class="col-2"><!-- Div muestra la fecha del pedido -->
                                                <p class="lead fw-normal mb-2">Fecha: ${data[i]['fecha']}</p>
                                            </div>
                                            <div class="col-2"><!-- Div muestra el estado del pedido -->
                                                <p class="lead fw-normal mb-2">Estado: ${data[i]['estado']}</p>
                                            </div>
                                            <div class="col-2"><!-- Div muestra el importe del pedido-->
                                                <h5 class="mb-0">Total: ${data[i]['precio']}€</h5>
                                            </div>
                                        </div>`;          

                        }
                        contenedor.innerHTML = tarjetas; //pintamos todas las tarjetas sobre el html
                    })
                    .catch((error) => console.error(error));

            }
        
    </script>