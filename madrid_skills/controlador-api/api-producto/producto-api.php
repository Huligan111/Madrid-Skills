<?php 

   include "../../modelo-clases/producto.php";
   //echo "Hola desde producto.php";

   
   //COMPROBAMOS SI LOS DATOS NOS VIENEN POR GET
   if ($_SERVER['REQUEST_METHOD'] == 'GET'){ 

       //Obtenemos todos los PEDIDOS
        if($_GET['nombre'] == 'productos'){ //si lo que viene por el url es GET y tiene nombre=clientes pasa por aquí
            $productos = Producto::getProductos();
            echo $productos;
            header("HTTP/1.1 200 OK");
            exit();
         }
    
   }


    //COMPROBAMOS SI LOS DATOS NOS VIENEN POR POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 

      //Insertar un PEDIDO
      if(isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['categoria']) && isset($_POST['unidadesStock']) && isset($_POST['imagen'])){
         $producto = new Producto($_POST['nombre'], $_POST['precio'], $_POST['categoria'], $_POST['unidadesStock'], $_POST['imagen']);
         echo $producto->setProducto($producto);
         header("HTTP/1.1 200 OK");
         exit();
       }
    }

    //COMPROBAR SI LOS DATOS NOS VIENEN POR PUT
    if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
      //Los parámetros se envían en el cuerpo de la solicitud utilizando el tipo de contenido application/x-www-form-urlencoded. 
      $put_data = file_get_contents('php://input');
      parse_str($put_data, $datos); //Los datos están el array $datos y se obtienen por su clave
      $producto = Producto::modificarProducto($datos);
      echo $producto; 
    }


    //COMPROBAMOS SI LOS DATOS QUE VIENEN SON PARA EL MÉTODO DELETE
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){

       //Eliminamos de la tabla Pedidos el id seleccionado
        if(isset($_GET['id'])){
            $producto = Producto::eliminarProducto($_GET['id']);
            echo $producto;
         header("HTTP/1.1 200 OK");
         exit();
       }

    }

   
   
?>