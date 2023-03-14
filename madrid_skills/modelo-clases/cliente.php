<?php 
   include_once "../../modelo-clases/conexionBD/conexionBD.php";

   class Cliente{

    public int $id;
    public string $usuario;
    public string $clave;
    public string $nombre;
    public string $apellidos;
    private string $genero;
    private string $fechaNacimiento;
    private string $telefono;
    private string $email;
    private string $direccion;
    private string $tipoIdentificador;
    private string $identificador;
    
    function __construct($usuario, $clave, $nombre, $apellidos, $genero, $fechaNacimiento, $telefono, $email, $direccion, $tipoIdentificador, $identificador){
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->genero = $genero;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->tipoIdentificador = $tipoIdentificador;
        $this->identificador = $identificador;
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

    function getGenero(){
        return $this->genero;
    }

    function getFechaNacimiento(){
        return $this->fechaNacimiento;
    }

    function getTelefono(){
        return $this->telefono;
    }

    function getEmail(){
        return $this->email;
    }

    function getDireccion(){
        return $this->direccion;
    }

    function getTipoIdentificador(){
        return $this->tipoIdentificador;
    }

    function getIdentificador(){
        return $this->identificador;
    }

    public static function getClientes(){
        $conn = connect(); //establecemos conexión con la base de datos
            //Obtenemos todos los datos 
            $consulta = $conn->prepare("SELECT * FROM cliente");        
            //Ejecutamos la consulta
            $consulta->execute();
            $arr = array();
            while ($row = $consulta->fetch(PDO::FETCH_ASSOC)){
             //En cada vuelta insertamos una fila en el array que después devolvemos en javascript
             array_push($arr,$row);
            }
        return json_encode($arr); //convertimos el array en json y lo enviamos en javascript
    }

    function setCliente($cliente){
        $conn = connect(); //establecemos conexión con la base de datos
        $sql = "INSERT INTO cliente (usuario, clave, nombre, apellidos, genero, fechaNacimiento, telefono, email, direccion, tipoIdentificador, identificador) VALUES ( :usuario, :clave, :nombre, :apellidos, :genero, :fechaNacimiento, :telefono, :email, :direccion, :tipoIdentificador, :identificador)";
          $datos = $conn->prepare($sql);
          $datos->bindValue(':usuario', $cliente->getUsuario());
          $datos->bindValue(':clave', $cliente->getClave());
          $datos->bindValue(':nombre', $cliente->getNombre());
          $datos->bindValue(':apellidos', $cliente->getApellidos());
          $datos->bindValue(':genero', $cliente->getGenero());
          $datos->bindValue(':fechaNacimiento', $cliente->getFechaNacimiento());
          $datos->bindValue(':telefono', $cliente->getTelefono());
          $datos->bindValue(':email', $cliente->getEmail());
          $datos->bindValue(':direccion', $cliente->getDireccion());
          $datos->bindValue(':tipoIdentificador', $cliente->getTipoIdentificador());
          $datos->bindValue(':identificador', $cliente->getIdentificador());
          //Ejecutamos y comprobamos el resultado 
          if($datos->execute()){
            return json_encode('Datos insertados correctamente');
          }
          
    }

    public static function registroSimple($clave, $usuario, $email){
        $conn = connect(); //establecemos conexión con la base de datos
        $sql = "INSERT INTO cliente (clave, usuario, email) VALUES ( :clave, :usuario, :email)";
          $datos = $conn->prepare($sql);
          $datos->bindValue(':clave', $clave);
          $datos->bindValue(':usuario', $usuario);
          $datos->bindValue(':email', $email);
          //Ejecutamos y comprobamos el resultado 
          if($datos->execute()){
            return json_encode('Datos insertados correctamente');
          }
    }

/*
    public static function loginCliente($usuario, $clave){
        $conn = connect(); //establecemos conexión con la base de datos
         //Obtenemos todos los datos de la tabla administrador
         $consulta = $conn->prepare("SELECT usuario, clave FROM cliente WHERE usuario=:usuario AND clave=:clave");        
         $consulta->bindParam(':usuario', $usuario);
         $consulta->bindParam(':clave', $clave);
         //Ejecutamos la consulta
         $consulta->execute();
         $results = $consulta->fetch(PDO::FETCH_ASSOC);

         if($results === false){
           //NO HAY FILAS (la consulta no ha devuelto filas)
               return json_encode("CLIENTE NO VALIDO");
         }else{
           //SI HAY FILAS (si la consulta devuelve resultado lo comprobamos) NO ES NECESARIO
           if($_POST['usuario'] == $results['usuario'] && $_POST['clave'] == $results['clave']) {
               return json_encode("CLIENTE VALIDO"); 
           }
         }
    }
*/
    public static function loginCliente($email, $clave){
        $conn = connect(); //establecemos conexión con la base de datos
         //Obtenemos todos los datos de la tabla administrador
         $consulta = $conn->prepare("SELECT email, clave FROM cliente WHERE email=:email AND clave=:clave");        
         $consulta->bindParam(':email', $email);
         $consulta->bindParam(':clave', $clave);
         //Ejecutamos la consulta
         $consulta->execute();
         $results = $consulta->fetch(PDO::FETCH_ASSOC);

         if($results === false){
           //NO HAY FILAS (la consulta no ha devuelto filas)
               return json_encode("CLIENTE NO VALIDO");
         }else{
           //SI HAY FILAS (si la consulta devuelve resultado lo comprobamos) NO ES NECESARIO
           if($_POST['email'] == $results['email'] && $_POST['clave'] == $results['clave']) {
               return json_encode("CLIENTE VALIDO"); 
           }
         }
    }

    public static function usuarioPorEmail($email){
      $conn = connect(); //establecemos conexión con la base de datos
      //Obtenemos el nombre de usuario que tiene el email recibido
      $consulta = $conn->prepare("SELECT usuario FROM cliente WHERE email=:email");        
      $consulta->bindParam(':email', $email);
      //Ejecutamos la consulta
      $consulta->execute();
      $results = $consulta->fetch(PDO::FETCH_ASSOC);
      $usuario = $results['usuario'];
      return $usuario;
    }
    /*
    public static function modificarCliente($datos){
        $conn = connect(); //establecemos conexión con la base de datos
        $id = $datos['id'];
        $usuario = $datos['usuario'];
        $clave = $datos['clave'];
        $nombre = $datos['nombre'];
        $apellidos = $datos['apellidos'];
        $genero = $datos['genero'];
        $fechaNacimiento = $datos['fechaNacimiento'];
        $telefono = $datos['telefono'];
        $email = $datos['email'];
        $direccion = $datos['direccion'];
        $tipoIdentificador = $datos['tipoIdentificador'];
        $identificador = $datos['identificador'];
        // preparar la sentencia SQL
        $sql = "UPDATE cliente SET usuario = ?, clave = ?, nombre = ?, apellidos = ?, genero = ?, fechaNacimiento = ?, telefono = ?, email = ?, direccion = ?, tipoIdentificador = ?, identificador = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usuario, $clave, $nombre, $apellidos, $genero, $fechaNacimiento, $telefono, $email, $direccion, $tipoIdentificador, $identificador, $id]);
        // comprobar si la actualización ha sido exitosa
        if ($stmt->rowCount() > 0) {
            return json_encode("CLIENTE ACTUALIZADO");
        } 
    }
    */

    public static function modificarCliente($datos){
        $conn = connect(); //establecemos conexión con la base de datos
        // $id = $datos['id'];
        $usuario = $datos['usuario'];
        //$clave = $datos['clave'];
        $nombre = $datos['nombre'];
        $apellidos = $datos['apellidos'];
        // $genero = $datos['genero'];
        $fechaNacimiento = $datos['fechaNacimiento'];
        $telefono = $datos['telefono'];
        $email = $datos['email'];
        $direccion = $datos['direccion'];
        $tipoIdentificador = $datos['tipoIdentificador'];
        $identificador = $datos['identificador'];
        //echo "usuario: ".$usuario."<br>";
        //echo "Nombre: ".$nombre."<br>";
        //echo "apellidos: ".$apellidos."<br>";
        //echo "fechaNacimiento: ".$fechaNacimiento."<br>";
        //echo "telefono: ".$telefono."<br>";
        //echo "email: ".$email."<br>";
        //echo "direccion: ".$direccion."<br>";
        //echo "tipoIdentificador: ".$tipoIdentificador."<br>";
        //echo "identificador: ".$identificador."<br>";
        // preparar la sentencia SQL
        $sql = "UPDATE cliente SET usuario = ?, nombre = ?, apellidos = ?, fechaNacimiento = ?, telefono = ?, email = ?, direccion = ?, tipoIdentificador = ?, identificador = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usuario, $nombre, $apellidos, $fechaNacimiento, $telefono, $email, $direccion, $tipoIdentificador, $identificador, $email]);
        // comprobar si la actualización ha sido exitosa
        if ($stmt->rowCount() > 0) {
            return json_encode("CLIENTE ACTUALIZADO");
        } 
    }

    public static function eliminarCliente($id){
        $conn = connect(); //establecemos conexión con la base de datos
        $statement = $conn->exec("DELETE FROM cliente where id=$id");
        if($statement === 0){
            return json_encode("CLIENTE NO ELIMINADO"); 
        }else{
            return json_encode("CLIENTE ELIMINADO");
        }  
    }




   }
?>