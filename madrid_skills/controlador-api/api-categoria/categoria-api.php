<?php 

   include "../../modelo-clases/categoria.php";
   //echo "Hola desde categoria.php";

   //COMPROBAMOS SI LOS DATOS NOS VIENEN POR GET
   if ($_SERVER['REQUEST_METHOD'] == 'GET'){ 
      //Comprobamos si nos piden todos los datos de la tabla CATEGORÍA
      if($_GET['nombre'] == 'categorias'){ //si lo que viene por el url es GET y tiene nombre=categorias
         $categorias = Categoria::getCategorias();
         echo $categorias;
         header("HTTP/1.1 200 OK");
         exit();
      }    
   }

   
   //COMPROBAMOS SI LOS DATOS NOS VIENEN POR POST
   if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
      //Comprobamos si los datos son para insertar en la tabla CATEGORIAS
      if(isset($_POST['nombre']) && isset($_POST['categoriaPadre'])){
         $categoria = new Categoria($_POST['nombre'], $_POST['categoriaPadre']);
         $categoria = $categoria->insertarCategoria($categoria);
         echo $categoria;
         header("HTTP/1.1 200 OK");
         exit();
      }    
   }

   //COMPROBAR SI LOS DATOS NOS VIENEN POR PUT
   if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
      //Los parámetros se envían en el cuerpo de la solicitud utilizando el tipo de contenido application/x-www-form-urlencoded. 
      $put_data = file_get_contents('php://input');
      parse_str($put_data, $datos); //Los datos están el array $datos y se obtienen por su clave
      $categoria = Categoria::modificarCategoria($datos);
      echo $categoria; 
    }

   //COMPROBAMOS SI LOS DATOS QUE VIENEN SON PARA EL MÉTODO DELETE
   if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
      //Eliminamos de la tabla CATEGORIAS el id seleccionado
      if(isset($_GET['id'])){
        // $statement = $conn->prepare("DELETE FROM categorias where id=:id");
        // $statement->bindValue(':id', $_GET['id']);
        // $statement->execute();
        $eliminar = Categoria::eliminarCategoria($_GET['id']);
      echo $eliminar;
      header("HTTP/1.1 200 OK");
      exit();
      }
   }
?>