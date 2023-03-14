<?php 
    include "../../modelo-clases/conexionBD/conexionBD.php";
   
   class Administrador{

    private int $id;
    private string $usuario;
    private string $clave;
    private string $nombre;
    private string $apellidos;
    private string $codigoEmpleado;


    function __construct($usuario, $clave, $nombre, $apellidos, $codigoEmpleado){
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->codigoEmpleado = $codigoEmpleado;
    }

    function getId(){
        return $this->id;
    }

    function getUsuario(){
        return $this->usuario;
    }

    function getClave(){
        return $this->clave;
    }

    function getNombre(){
        return $this->nombre;
    }

    function getApellidos(){
        return $this->apellidos;
    }

    function getCodigoEmpleado(){
        return $this->codigoEmpleado;
    }

    //Obtenemos todos los administradores
    public static function getAdministradores(){
        $conn = connect(); //establecemos conexión con la base de datos
            //Obtenemos todos los datos de la tabla administrador
            $consulta = $conn->prepare("SELECT * FROM administrador");        
            //Ejecutamos la consulta
            $consulta->execute();
            $arr = array();
            while ($row = $consulta->fetch(PDO::FETCH_ASSOC)){
             //En cada vuelta insertamos una fila en el array que después devolvemos
             array_push($arr,$row);
            }
            return json_encode($arr); //convertimos el array en json y lo enviamos
    }

    //Obtenemos un solo administrador
    public static function getAdministrador($id){
        $conn = connect();
             //Obtenemos todos los datos de la tabla administrador
             $consulta = $conn->prepare("SELECT * FROM administrador where id = :id");        
             $consulta->bindParam(':id', $id);
             //Ejecutamos la consulta
             $consulta->execute();
             $arr = array();
             while ($row = $consulta->fetch(PDO::FETCH_ASSOC)){
              //En cada vuelta insertamos una fila en el array que después devolvemos
              array_push($arr,$row);
             }
             return json_encode($arr); //convertimos el array en json y lo enviamos
    } 


    function insertarAdministrador($admin){
        $conn = connect();
        $sql = "INSERT INTO administrador (usuario, clave, nombre, apellidos, codigoEmpleado) VALUES ( :usuario, :clave, :nombre, :apellidos, :codigoEmpleado)";
          $datos = $conn->prepare($sql);
          $datos->bindValue(':usuario', $admin->getUsuario());
          $datos->bindValue(':clave', $admin->getClave());
          $datos->bindValue(':nombre', $admin->getNombre());
          $datos->bindValue(':apellidos', $admin->getApellidos());
          $datos->bindValue(':codigoEmpleado', $admin->getCodigoEmpleado());
          //Ejecutamos y comprobamos el resultado 
          if($datos->execute()){
            return json_encode('Datos insertados correctamente');
          }
    }

    public static function loginAdministrador($usuario, $clave){
        $conn = connect();
        //Obtenemos todos los datos de la tabla administrador
        $consulta = $conn->prepare("SELECT usuario, clave FROM administrador WHERE usuario=:usuario AND clave=:clave");        
        $consulta->bindParam(':usuario', $usuario);
        $consulta->bindParam(':clave', $clave);
        //Ejecutamos la consulta
        $consulta->execute();
        $results = $consulta->fetch(PDO::FETCH_ASSOC);

        if($results === false){
          //NO HAY FILAS (la consulta no ha devuelto filas)
            return json_encode("ADMINISTRADOR NO VALIDO");
        }else{
          //SI HAY FILAS (si la consulta devuelve resultado lo comprobamos)
          if($_POST['usuario'] == $results['usuario'] && $_POST['clave'] == $results['clave']) {
              return json_encode("ADMINISTRADOR VALIDO");
          }
        }
    }


   }

?>