<?php 

    include "../../modelo-clases/conexionBD/conexionBD.php";    

   class Pedido{

    private int $id;
    private string $usuario;
    private string $fecha;
    private float $precio;
    private $productos; //Vendrá en formato array o json
    private $estado;

    function __construct($usuario, $precio, $productos, $estado){
        $this->usuario = $usuario;
        $this->fecha = date('Y-m-d'); //fecha de hoy
        $this->precio = $precio;
        $this->productos = $productos;
        $this->estado = $estado;
    }

    function getId(){
        return $this->id;
    }

    function getUsuario(){
        return $this->usuario;
    }

    function getFecha(){
        return $this->fecha;
    }

    function getPrecio(){
        return $this->precio;
    }

    function getProductos(){
        return $this->productos;
    }

    function getEstado(){
        return $this->estado;
    }

    
    public static function getPedidos(){
        $conn = connect(); //establecemos conexión con la base de datos
        $consulta = $conn->prepare("SELECT * FROM pedidos");        
        $consulta->execute();
        $arr = array();
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)){
         //En cada vuelta insertamos una fila en el array que después devolvemos en javascript
         array_push($arr,$row);
        }
        return json_encode($arr); //convertimos el array en json
    }
    

    public static function getPedidosUsuario($usuario){
        $conn = connect(); //establecemos conexión con la base de datos
        $consulta = $conn->prepare("SELECT * FROM pedidos WHERE usuario = '$usuario'");        
        $consulta->execute();
        $arr = array();
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)){
         //En cada vuelta insertamos una fila en el array que después devolvemos en javascript
         array_push($arr,$row);
        }
        return json_encode($arr); //convertimos el array en json
    }

    function setPedido($pedido){
        $conn = connect(); //establecemos conexión con la base de datos
        $sql = "INSERT INTO pedidos (usuario, fecha, precio, productos, estado) VALUES ( :usuario, :fecha, :precio, :productos, :estado)";
          $datos = $conn->prepare($sql);
          $datos->bindValue(':usuario', $pedido->getUsuario());
          $datos->bindValue(':fecha', $pedido->getFecha());
          $datos->bindValue(':precio', $pedido->getPrecio());
          $datos->bindValue(':productos', $pedido->getProductos());
          $datos->bindValue(':estado', $pedido->getEstado());
          //Ejecutamos y comprobamos el resultado 
          if($datos->execute()){
            return json_encode('Datos insertados correctamente');
          }
    }

    public static function eliminarPedido($id){
        $conn = connect(); //establecemos conexión con la base de datos
        $statement = $conn->exec("DELETE FROM pedidos where id=$id");
        if($statement === 0){
            return json_encode("PEDIDO NO ELIMINADO"); 
        }else{
            return json_encode("PEDIDO ELIMINADO");
        }  
    }

    public static function modificarPedido($datos){
        $conn = connect(); //establecemos conexión con la base de datos
        $id = $datos['id'];
        $usuario = $datos['usuario'];
        $fecha = $datos['fecha'];
        $precio = $datos['precio'];
        $productos = $datos['productos'];
        $estado = $datos['estado'];
        // preparar la sentencia SQL
        $sql = "UPDATE pedidos SET usuario = ?, fecha = ?, precio = ?, productos = ?, estado = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usuario, $fecha, $precio, $productos, $estado, $id]);
        // comprobar si la actualización ha sido exitosa
        if ($stmt->rowCount() > 0) {
            return json_encode("PEDIDO ACTUALIZADO");
        } else {
            return json_encode("PEDIDO NO ACTUALIZADO");
        }

    }
    



}
?>