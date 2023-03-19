<?php 


class ProductModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    
    public function insert($data){
        $result;

        try{
            $sql = 'CALL sp_add_product(
                :title, 
                :description, 
                :price, 
                :quantity, 
                :category, 
                :image_name, 
                :image_extension)';

            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            $query->execute($data);

            $result = true;

        }catch(PDOException $e){
            $result = 'Error en la Base de datos';
        }

        return $result;
    }
    
    public function getAll(){

        $items = [];

        try{
            $connection = $this->db->connect();
            $query = $connection->query('CALL sp_get_all_products()');

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

    public function getByCategory($category){

        $items = [];

        try{
            $connection = $this->db->connect();
            $sql = 'CALL sp_get_products_by_category(:p_category)';
            $query = $connection->prepare($sql);
            $query->execute(array( 'p_category' => $category ));
            
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

    public function getBySearch($search){

        $items = [];

        try{
            $connection = $this->db->connect();
            $sql = 'CALL sp_get_products_by_title(:p_title)';
            $query = $connection->prepare($sql);
            $query->execute(array( 'p_title' => $search ));
            
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


    public function getOne($id){

        $item = null;

        try{
            $sql = 'CALL sp_get_one_product(:id)';
            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            $query->execute(array( 'id' => $id ));

            if($query->rowCount() > 0){
                $item = $query->fetch();
            }

        }catch(PDOException $e){
            echo $e;
        }

        return $item;

    }

    public function getProductsInCart(){
        $items = [];

        $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();


        if(count($products_in_cart) > 0){

            $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
            
            try{

                $connection = $this->db->connect();
                $sql = 'SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')';
                $query = $connection->prepare($sql);
                $query->execute(array_keys($products_in_cart));

                if($query->rowCount() > 0){
                    while($row = $query->fetch()){
                        $item = $row;
                        array_push($items, $item);
                    }
                }
    
            }catch(PDOException $e){
                echo $e;
            }
        }

        

        return $items;
    }

}

?>