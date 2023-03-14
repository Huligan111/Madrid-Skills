<?php 

   include "../../modelo-clases/cliente.php";
   //echo "Hola desde cliente.php";

   //COMPROBAMOS SI LOS DATOS NOS VIENEN POR GET
   if ($_SERVER['REQUEST_METHOD'] == 'GET'){ 

        //Comprobamos si nos piden los datos de todos los CLIENTES
        if($_GET['nombre'] == 'clientes'){ //si lo que viene por el url es GET y tiene nombre=clientes pasa por aquí
          $clientes = Cliente::getClientes();
          echo $clientes;
          header("HTTP/1.1 200 OK");
          exit();
        }
    
   }


       //COMPROBAMOS SI LOS DATOS NOS VIENEN POR POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 

          //Comprobamos si los datos son para la tabla CLIENTE
        if(isset($_POST['usuario']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['fechaNacimiento']) && isset($_POST['telefono']) && isset($_POST['email']) && isset($_POST['direccion']) && isset($_POST['tipoIdentificador']) && isset($_POST['identificador'])){
          $datos = array();
          $datos['usuario'] = $_POST['usuario'];
          $datos['nombre'] = $_POST['nombre'];
          $datos['apellidos'] = $_POST['apellidos'];
          $datos['fechaNacimiento'] = $_POST['fechaNacimiento'];
          $datos['telefono'] = $_POST['telefono'];
          $datos['email'] = $_POST['email'];
          $datos['direccion'] = $_POST['direccion'];
          $datos['tipoIdentificador'] = $_POST['tipoIdentificador'];
          $datos['identificador'] = $_POST['identificador'];
          $cliente = Cliente::modificarCliente($datos);
          echo $cliente;
          header("HTTP/1.1 200 OK");
          exit();
        }

        //Comprobamos si los datos son para la tabla CLIENTE version registro simplificado
        if(isset($_POST['clave']) && isset($_POST['clave2']) && isset($_POST['usuario']) && isset($_POST['email'])){
          $cliente = Cliente::registroSimple($_POST['clave'], $_POST['usuario'], $_POST['email']);
          echo $cliente;
          header("HTTP/1.1 200 OK");
          exit();
        }


        //Comprobamos si los datos son para login de CLIENTE 
        //if(isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['loginCliente'])){
        //  $cliente = Cliente::loginCliente($_POST['usuario'], $_POST['clave']);
        //  echo $cliente;
        //  header("HTTP/1.1 200 OK");
        //  exit();
        //}

        //Comprobamos si los datos son para login de CLIENTE 
        if(isset($_POST['email']) && isset($_POST['clave']) && isset($_POST['loginCliente'])){
          $cliente = Cliente::loginCliente($_POST['email'], $_POST['clave']);
          echo $cliente;
          header("HTTP/1.1 200 OK");
          exit();
        }
    }


    //COMPROBAR SI LOS DATOS NOS VIENEN POR PUT
    if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
      //Los parámetros se envían en el cuerpo de la solicitud utilizando el tipo de contenido application/x-www-form-urlencoded. 
      $put_data = file_get_contents('php://input');
      parse_str($put_data, $datos); //Los datos están el array $datos y se obtienen por su clave
      $cliente = Cliente::modificarCliente($datos);
      echo $cliente; 
    }


    //COMPROBAMOS SI LOS DATOS QUE VIENEN SON PARA EL MÉTODO DELETE
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        //Eliminamos de la tabla Clientes el id seleccionado
        if(isset($_GET['id'])){
          $cliente = Cliente::eliminarCliente($_GET['id']);
          echo $cliente;
	        header("HTTP/1.1 200 OK");
	        exit();
        }
    }

   
   
?>