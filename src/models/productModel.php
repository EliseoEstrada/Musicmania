<?php 

class Movie{

    public $id;
    public $title;
    public $image;

}

class ProductModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    
    public function insert($data){
        $result;

        try{
            $sql = 'CALL sp_addProduct(
                :title, 
                :description, 
                :price, 
                :amount, 
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
            $query = $this->db->connect()->query('SELECT * FROM peliculas');

            if($query->rowCount() > 0){
                while($row = $query->fetch()){
                    $item = new Movie();
                    $item->id      = $row['id'];
                    $item->title   = $row['titulo'];
                    $item->image   = $row['imagen'];
    
                    array_push($items, $item);
                }
            }

        }catch(PDOException $e){
            echo $e;
        }

        return $items;
    }

    public function getOne($id){
        $item = new Movie();
        $sql = 'SELECT * FROM peliculas WHERE id= :id';
        $query = $this->db->connect()->prepare($sql);
        $query->execute(array('id' => $id));
        

        if($query->rowCount() == 1){
            $row = $query->fetch();
            $item->id      = $row['id'];
            $item->title   = $row['titulo'];
            $item->image   = $row['imagen'];

        }

        

        return $item;

    }

}

?>