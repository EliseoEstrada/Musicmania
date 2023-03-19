<?php 


class CategoryModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function getAll(){

        $items = [];

        try{
            $query = $this->db->connect()->query('SELECT * FROM categories ORDER BY name');

            if($query->rowCount() > 0){
                while($row = $query->fetch()){
                    $item = array(
                        'id'    =>$row['id'],
                        'name'  =>$row['name']
                    );    
                    array_push($items, $item);
                }
            }

        }catch(PDOException $e){
            echo $e;
        }

        return $items;
    }

}

?>