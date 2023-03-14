<section class="h-100" style="background-color: #eee;">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-10">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0 text-black">Productos</h3>
                    <div>
                        <p class="mb-0">
                            <a href="#!" class="text-body text-decoration-none">
                                <span class="text-muted ">Seguir comprando</span>
                                <i class="bi bi-bag-plus-fill"></i>
                            </a>
                        </p>
                    </div>
                </div>

                <div class="card rounded-3 mb-4">
                    <div id="contenedor" class="card-body p-4">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2"><!-- Div que muestra la imagen del producto -->
                                <img src="../icon/Packing/Packing_128px.png" class="img-fluid rounded-3">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3"><!-- Div muestra el nombre del producto -->
                                <p class="lead fw-normal mb-2">Nombre</p>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex"><!-- Div que muestra la cantidad y los botones para modificarla -->
                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control form-control-sm" />
                                <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1"><!-- Div muestra precio -->
                                <h5 class="mb-0">€</h5>
                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end"><!-- Div con el icono de la papelera -->
                                <a href="#" class="text-danger">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4"><!-- Div para aplicar código descuento -->
                    <div class="card-body p-4 d-flex flex-row">
                        <div class="form-outline flex-fill">
                            <input type="text" id="form1" class="form-control form-control-lg" />
                            <label class="form-label" for="form1">Código de descuento</label>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-lg ms-3">Aplicar</button>
                    </div>
                </div>

                <div class="card"><!-- Div con el botón de pagar -->
                    <div class="card-body">
                        <button id="botonPagar" type="button" class="btn btn-warning btn-block btn-lg" onclick="this.disabled=true;">Pagar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    //Este código se inicia al iniciar la pagina
    window.addEventListener("load", mostrarCarrito);

    //Obtenemos los productos que ha seleccionado el cliente en la pagina principal que habíamos almacenado en la memoria del navegador
    const productosCesta = JSON.parse(sessionStorage.getItem("productosSeleccionados")); //obtenemos los objetos de la memoria
    let totalPagar = 0;
    
    function mostrarCarrito(e){
        //console.log(productosCesta);
        let tarjetas = "";
        for (let i = 0; i < productosCesta.length; i++) {
            console.log(productosCesta[i]);
            tarjetas += `<div class="card mb-3" style="max-width: 1400px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="../icon/Packing/Packing_128px.png" style=" max-height: 200px;" alt="" class="img-fluid rounded-start">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                        <h5 class="card-title">${productosCesta[i].nombre}</h5>
                                        <h6 class="card-subtitle text-muted mb-2">${productosCesta[i].categoria}</h6>
                                            <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non blanditiis hic adipisci quia ipsa accusantium, delectus fugiat, at perspiciatis tempora ea unde obcaecati quidem tempore eum totam pariatur voluptas. Iusto.</p>
                                            <h6 class="card-subtitle text-muted mb-2">Unidades en stock: ${productosCesta[i].unidadesStock}</h6>
                                            <h6 class="card-subtitle text-muted mb-2">Precio por unidad: ${productosCesta[i].precio} €</h6>
                                        </div>
                                    </div>
                                </div>
                            </div> `;
            totalPagar += productosCesta[i].precio; //aquí calculamos el total de precio que se muestra debajo en el carrito

        }
        //Incluimos el total de precio de todos los productos en el carrito
        tarjetas += `<div class="alert alert-secondary mt-3 d-flex justify-content-between align-items-center" role="alert">
                            <strong>Subtotal (${productosCesta.length} productos): ${totalPagar} €</strong>
                        </div>`;
        //Mostramos todos los productos y su total 
        document.getElementById('contenedor').innerHTML = tarjetas;
    };

    //Esta función se ejecuta cuando se pulsa el botón pagar
    const botonPagar = document.getElementById('botonPagar');
    botonPagar.addEventListener('click', function(e) {
        //Esto son los datos que enviamos a php
        const datos = {
            email: `${sessionStorage.getItem("emailUsuario")}`,
            precio: totalPagar,
            productos:  JSON.stringify(productosCesta),
            estado: 'en preparacion'
        };
        //console.log(datos);
        fetch('../controlador-api/api-pedido/pedido-api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(datos)
            })
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.error(error));
    });
</script>