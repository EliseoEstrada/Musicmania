<?php 


class OrderModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($data){
        $result;

        try{
            $sql = 'CALL sp_create_order(
                :user_id, 
                :total)';

            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            $query->execute($data);

            if($query->rowCount() > 0){
                while($row = $query->fetch()){
                    $result = $row['LAST_INSERT_ID()']; //id de venta
                }
            }else{
                $result = false;
            }

        }catch(PDOException $e){
            $result = false;
        }

        return $result;
    }

    public function insertItem($data){
        $result;

        try{
            $sql = 'CALL sp_add_item_order(
                :order_id, 
                :product_id,
                :quantity,
                :subtotal)';

            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            $query->execute($data);

            $result = true;

        }catch(PDOException $e){
            $result = false;
        }

        return $result;
    }

    public function getOrdersByUser($idUser){
        
        $items = [];

        try{
            $connection = $this->db->connect();
            $sql = 'CALL sp_get_orders_by_user(:p_idUser)';
            $query = $connection->prepare($sql);
            $query->execute(array( 'p_idUser' => $idUser ));
            
            if($query->rowCount() > 0){
                while($row = $query->fetch()){
                    $item = $row;
                    array_push($items, $item);
                }
            }

        }catch(PDOException $e){
            echo $e;
        }

        return $items;
    }

    public function getProductOrderById($idUser, $idProduct){
        $result;

        try{
            $connection = $this->db->connect();
            $sql = 'CALL sp_get_products_orders_by_id(:p_idUser, :p_idProduct)';
            $query = $connection->prepare($sql);
            $query->execute(array( 'p_idUser' => $idUser, 'p_idProduct' => $idProduct));
            
            if($query->rowCount() > 0){
                $result = true;
            }else{
                $result = false;
            }

        }catch(PDOException $e){
            $result = false;
        }

        return $result;
    }

}