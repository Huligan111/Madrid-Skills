<?php 
   include "../../modelo-clases/conexionBD/conexionBD.php"; 

   class Producto{

    private int $id;
    private string $nombre;
    private float $precio;
    private string $categoria;
    private int $unidadesStock;
    private string $imagen;

    function __construct( $nombre, $precio, $categoria, $unidadesStock, $imagen){
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->categoria = $categoria;
        $this->unidadesStock = $unidadesStock;
        $this->imagen = $imagen;
    }

    function getId(){
        return $this->id;
    }

    function getNombre(){
        return $this->nombre;
    }

    function getPrecio(){
        return $this->precio;
    }

    function getCategoria(){
        return $this->categoria;
    }

    function getUnidadesStock(){
        return $this->unidadesStock;
    }

    function getImagen(){
        return $this->imagen;
    }

    public static function getProductos(){
        $conn = connect(); //establecemos conexión con la base de datos
        $consulta = $conn->prepare("SELECT * FROM productos");        
        $consulta->execute();
        $arr = array();
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)){
         //En cada vuelta insertamos una fila en el array que después devolvemos en javascript
         array_push($arr,$row);
        }
        return json_encode($arr); //convertimos el array en json
    }

    function setProducto($producto){
        $conn = connect(); //establecemos conexión con la base de datos
        $sql = "INSERT INTO productos (nombre, precio, categoria, unidadesStock, imagen) VALUES ( :nombre, :precio, :categoria, :unidadesStock, :imagen)";
          $datos = $conn->prepare($sql);
          $datos->bindValue(':nombre', $producto->getNombre());
          $datos->bindValue(':precio', $producto->getPrecio());
          $datos->bindValue(':categoria', $producto->getCategoria());
          $datos->bindValue(':unidadesStock', $producto->getUnidadesStock());
          $datos->bindValue(':imagen', $producto->getImagen());
          //Ejecutamos y comprobamos el resultado 
          if($datos->execute()){
            return json_encode('Datos insertados correctamente');
          }
    }

    public static function modificarProducto($datos){
        $conn = connect(); //establecemos conexión con la base de datos
        $id = $datos['id'];
        $nombre = $datos['nombre'];
        $precio = $datos['precio'];
        $categoria = $datos['categoria'];
        $unidadesStock = $datos['unidadesStock'];
        $imagen = $datos['imagen'];
        // preparar la sentencia SQL
        $sql = "UPDATE productos SET nombre = ?, precio = ?, categoria = ?, unidadesStock = ?, imagen = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $precio, $categoria, $unidadesStock, $imagen, $id]);
        // comprobar si la actualización ha sido exitosa
        if ($stmt->rowCount() > 0) {
            return json_encode("PRODUCTO ACTUALIZADO");
        } else {
            return json_encode("PRODUCTO NO ACTUALIZADO");
        }
    }

    public static function eliminarProducto($id){
        $conn = connect(); //establecemos conexión con la base de datos
        $statement = $conn->exec("DELETE FROM productos where id=$id");
        if($statement === 0){
            return json_encode("PRODUCTO NO ELIMINADO"); 
        }else{
            return json_encode("PRODUCTO ELIMINADO");
        }  
    }

   }
?>