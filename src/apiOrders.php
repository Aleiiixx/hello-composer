<?php
namespace LMXaire;

include 'ordersInfo.php';

class APIOrders{

    function getAll(){

        $infoOrders = new ordersInfo();
        $info = array();
        $info['register'] = array();

        if (isset($_GET['company'])){
            $result = $infoOrders->getInfo($_GET['company'], null);
        } else if (isset($_GET['date'])){
            $result = $infoOrders->getInfo(null, $_GET['date']);
        } else {
            $result = $infoOrders->getInfo(null, null);
        }

        if ($result->rowCount()){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $register = array(
                    'id_order' => $row['id_order'],
                    'date' => $row['date'],
                    'company' => $row['company'],
                    'qty' => $row['qty']
                );
                array_push($info['register'], $register);
            }

            http_response_code(200);
            echo json_encode($info);
        }else{
            http_response_code(404);
            echo json_encode(array('message' => 'Element not found'));
        }
    }
}

$api = new APIOrders();
$api->getAll();

?>