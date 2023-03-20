<?php 

class ReviewModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($data){
        $result;

        try{
            $sql = 'CALL sp_add_review(
                :user_id, 
                :product_id, 
                :comment, 
                :punctuation)';

            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            $query->execute($data);

            $result = true;

        }catch(PDOException $e){
            $result = false;
        }

        return $result;
    }

    public function getAll($idProduct){

        $items = [];

        try{
            $connection = $this->db->connect();
            $sql = 'CALL sp_get_all_reviews(:p_product_id)';
            $query = $connection->prepare($sql);
            $query->execute(array( 'p_product_id' => $idProduct ));

            if($query->rowCount() > 0){
                while($row = $query->fetch()){
                    $item = $row;
    
                    array_push($items, $item);
                }
            }

        }catch(PDOException $e){
            return $items;
        }

        return $items;
    }
}