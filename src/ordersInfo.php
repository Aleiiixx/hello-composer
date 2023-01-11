<?php
namespace LMXaire;

include 'connDB.php';

class ordersInfo extends PDOConn{

    function getInfo($company, $date){

        if (!is_null($company)){
            $result = $this->connect()->query('SELECT * FROM orders WHERE company = ' . $company . '');
        }
        
        if (!is_null($date)){
            $result = $this->connect()->query('SELECT * FROM orders WHERE date > "' . $date . '"' );
        }

        if (is_null($company) AND is_null($date)){
            $result = $this->connect()->query('SELECT * FROM orders');
        }
        

        return $result;
    }
}

?>