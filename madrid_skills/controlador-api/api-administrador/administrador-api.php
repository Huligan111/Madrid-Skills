<?php 
   //include "../../modelo-clases/conexionBD/conexionBD.php";
   include "../../modelo-clases/administrador.php";
   //echo "Hola desde administrador.php";

   //COMPROBAMOS SI LOS DATOS NOS VIENEN POR GET
   if ($_SERVER['REQUEST_METHOD'] == 'GET'){ 

    //Comprobamos si nos piden un solo ADMINISTRADOR
    if(isset($_GET['id'])){ //si lo que viene por el url es GET y tiene id=numero pasa por aquí
      echo Administrador::getAdministrador($_GET['id']);
      header("HTTP/1.1 200 OK");
      exit();
    }

    //Comprobamos si nos piden todos los ADMINISTRADORES
    if($_GET['nombre'] == 'administradores'){ //si lo que viene por el url es GET y tiene nombre=administradores pasa por aquí
      echo Administrador::getAdministradores();
      header("HTTP/1.1 200 OK");
      exit();
    }

   }


   //COMPROBAMOS SI LOS DATOS NOS VIENEN POR POST
   if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 

      //Crear nuevo ADMINISTRADOR
      if(isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['codigoEmpleado'])){
        //Creamos un administrador con los datos y llamamos el método para insertarlo en la BD
          $administrador = new Administrador($_POST['usuario'], $_POST['clave'], $_POST['nombre'], $_POST['apellidos'], $_POST['codigoEmpleado']);
          echo $administrador->insertarAdministrador($administrador);
          header("HTTP/1.1 200 OK");
          exit();
      }
    

   //Comprobamos si el login del ADMINISTRADOR es valido
   if(isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['login'])){
       $login = Administrador::loginAdministrador($_POST['usuario'],$_POST['clave']);
       echo $login;
       header("HTTP/1.1 200 OK");
       exit();
   }



   }

?>