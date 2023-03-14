<?php 
   include "../../modelo-clases/conexionBD/conexionBD.php";

   class Categoria{

       private int $id;
       private string $nombre;
       private string $categoriaPadre;

       function __construct($nombre, $categoriaPadre){
            $this->nombre = $nombre;
            $this->categoriaPadre = $categoriaPadre;
       }

       function getId(){
        return $this->id;
       }

       function getNombre(){
        return $this->nombre;
       }

       function getCategoriaPadre(){
        return $this->categoriaPadre;
       }

       public static function getCategorias(){
        $conn = connect(); //establecemos conexión con la base de datos
            //Obtenemos todos los datos 
            $consulta = $conn->prepare("SELECT * FROM categorias");        
            //Ejecutamos la consulta
            $consulta->execute();
            $arr = array();
            while ($row = $consulta->fetch(PDO::FETCH_ASSOC)){
             //En cada vuelta insertamos una fila en el array que después devolvemos
             array_push($arr,$row);
            }
        return json_encode($arr); //convertimos el array en json
       }

       function insertarCategoria($categoria){
        $conn = connect(); //establecemos conexión con la base de datos
            $sql = "INSERT INTO categorias (nombre, categoriaPadre) VALUES ( :nombre, :categoriaPadre)";
            $datos = $conn->prepare($sql);
            $datos->bindValue(':nombre', $categoria->getNombre());
            $datos->bindValue(':categoriaPadre', $categoria->getCategoriaPadre());
            //Ejecutamos y comprobamos el resultado 
            if($datos->execute()){
                return json_encode('Datos insertados correctamente');
            }
        return json_encode('Error al insertados los datos');
       }

       public static function modificarCategoria($datos){
        $conn = connect(); //establecemos conexión con la base de datos
        $id = $datos['id'];
        $nombre = $datos['nombre'];
        $categoriaPadre = $datos['categoriaPadre'];
        // preparar la sentencia SQL
        $sql = "UPDATE categorias SET nombre = ?, categoriaPadre = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $categoriaPadre, $id]);
        // comprobar si la actualización ha sido exitosa
        if ($stmt->rowCount() > 0) {
            return json_encode("CATEGORIA ACTUALIZADA");
        } 
    }

       public static function eliminarCategoria($id){
        $conn = connect(); //establecemos conexión con la base de datos
            $statement = $conn->prepare("DELETE FROM categorias where id=:id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        return json_encode("Categoria eliminada");
       }    
   }
?>