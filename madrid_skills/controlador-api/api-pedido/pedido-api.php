<?php 

   include "../../modelo-clases/pedido.php";
   include_once "../../modelo-clases/cliente.php";
   //echo "Hola desde pedidos.php";

   //COMPROBAMOS SI LOS DATOS NOS VIENEN POR GET
   if ($_SERVER['REQUEST_METHOD'] == 'GET'){ 

       //Obtenemos todos los PEDIDOS
        /*if($_GET['nombre'] == 'pedidos'){ //si lo que viene por el url es GET y tiene nombre=clientes pasa por aquí
            $pedidos = Pedido::getPedidos();
            echo $pedidos;
            header("HTTP/1.1 200 OK");
            exit();
         }*/

         //Obtenemos todos los PEDIDOS del usuario
        if(isset($_GET['email'])){ //si lo que viene por el url es GET y tiene nombre=clientes pasa por aquí
         $usuario = Cliente::usuarioPorEmail($_GET['email']);
         //echo $usuario;
         $pedidos = Pedido::getPedidosUsuario($usuario);
         echo $pedidos;
         header("HTTP/1.1 200 OK");
         exit();
      }
    
   }


    //COMPROBAMOS SI LOS DATOS NOS VIENEN POR POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 

      //Insertar un PEDIDO
      //Recibimos los datos que se envían desde carrito.php
      $datos = json_decode(file_get_contents('php://input'), true);

      $email = $datos['email'];
      //Obtenemos el nombre de usuario que tiene el email recibido
      $usuario = Cliente::usuarioPorEmail($email);
      $precio = $datos['precio'];
      $productos = $datos['productos'];
      $estado = $datos['estado'];
      
      $pedido = new Pedido($usuario, $precio, $productos, $estado);
      echo $pedido->setPedido($pedido); 
      header("HTTP/1.1 200 OK");
      exit();
    }

    //COMPROBAR SI LOS DATOS NOS VIENEN POR PUT
    if ($_SERVER['REQUEST_METHOD'] == 'PUT'){

      //Los parámetros se envían en el cuerpo de la solicitud utilizando el tipo de contenido application/x-www-form-urlencoded. 
      $put_data = file_get_contents('php://input');
      parse_str($put_data, $datos); //Los datos están el array $datos y se obtienen por su clave
      
      //$id = $datos['id'];
      //$usuario = $datos['usuario'];
      //$fecha = $datos['fecha'];
      //$precio = $datos['precio'];
      //$productos = $datos['productos'];
      //echo $id." ".$usuario." ".$fecha." ".$precio." ".$productos;
      $pedido = Pedido::modificarPedido($datos);
      echo $pedido;
      

    }


    //COMPROBAMOS SI LOS DATOS QUE VIENEN SON PARA EL MÉTODO DELETE
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){

       //Eliminamos de la tabla Pedidos el id seleccionado
        if(isset($_GET['id'])){
            //$statement = $conn->prepare("DELETE FROM pedidos where id=:id");
            //$statement->bindValue(':id', $_GET['id']);
            //$statement->execute();
            $pedido = Pedido::eliminarPedido($_GET['id']);
            echo $pedido;
         header("HTTP/1.1 200 OK");
         exit();
       }

    }

   
   
?>