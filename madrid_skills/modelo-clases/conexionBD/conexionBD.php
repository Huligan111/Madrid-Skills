<?php 
   //Este array contiene los datos de la conexión con la base de datos


//Abrir conexión a la base de datos
function connect(){   //el parámetro es el array con los datos de la conexión con la bd que esta en config.php
    
    $db = [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db' => 'tienda' //Nombre base de datos
    ];

    try {
        $conn = new PDO("mysql:host={$db['host']};dbname={$db['db']}", $db['username'], $db['password']);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conexión establecida";
        return $conn;
    } catch (PDOException $exception) {
        exit($exception->getMessage());
    }
}

?>