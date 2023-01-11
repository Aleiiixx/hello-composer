<?php
namespace LMXaire;

class PDOConn{


    public static $dbName = 'icb0006_uf4_pr01';

    private static $serverName = 'localhost';

    private static $userName = 'root';

    private static $password = 'root';

    public static $conn;


    static function connect(){
        try{
            self::$conn = new PDO('mysql:host='.self::$serverName.';dbname='.self::$dbName,self::$userName,self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo('conected succesfully');
        }catch(PDOException $e){
            echo "Conection failed: ". $e->getMessage();
        }
        return(self::$conn);
    }
    
    static function disconnect(){
        self::$conn = null;
        echo "Disconected succesfully!";
    }

    
    static function insertOrdersData($qty, $companyName, $date){
        
        try{
            $stmt = self::$conn->prepare("INSERT INTO orders (date,company,qty) VALUES (:dateValue,:company,:qty);");
            $stmt->bindParam('dateValue', $date);
            $stmt->bindParam('company', $companyName);
            $stmt->bindParam('qty', $qty);
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e){
            echo 'Insert failed: ' . $e->getMessage();
        }
    }
}