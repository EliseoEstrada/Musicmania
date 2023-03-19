<?php 

class User{

    public $id;
    public $username;
    public $email;
    public $password;
    public $image;
    public $extension;

}

class UserModel extends Model{

    public function __construct(){
        parent::__construct();
    }



    public function insert($data){
        
        $result;
        $repeatUser = $this->repeatUser($data['username']);
        if($repeatUser){
            return $result = 'Usuario repetido';
        }

        try{
            $sql = 'CALL sp_signup(:username, :email, :password)';
            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            $query->execute($data);

            $id = $connection->lastInsertId();
            
            $newUser = array(
                'id'        => $id,
                'username'  => $data['username'],
                'email'     => $data['email'],
                'password'  => $data['password'],
                'image'     => null, 
                'extension' => null
            );

            $result = $newUser;

        }catch(PDOException $e){
            $result = 'Error en la Base de datos';
        }

        return $result;
    
    }

    public function login($data){
        $result;

        try{
            $sql = 'CALL sp_login(:user, :password)';
            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            $query->execute($data);

            
            if($query->rowCount() > 0){
                $row = $query->fetch();

                $user = array(
                    'id'         => $row['id'],
                    'username'   => $row['username'],
                    'email'      => $row['email'],
                    'password'   => $row['password'],
                    'address'    => $row['address'],
                    'image'      => $row['image'],
                    'extension'  => $row['extension']
                );
                $result = $user;
            }else{
                $result = 'Credenciales incorrectas';
            }

        }catch(PDOException $e){
            $result = 'Error en la Base de datos';
        }

        return $result;
    }

    public function updateData($data){
        
        $result;

        if( $data['username'] != $_SESSION['identity']['username']){
            $repeatUser = $this->repeatUser($data['username']);
            if($repeatUser){
                return $result = 'El usuario ya existe';
            }
        }

        try{
            $sql = 'CALL sp_update_user_data(:id, :username, :email, :address)';
            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            
            if($query->execute($data)){
                $result = true;
            }

        }catch(PDOException $e){
            $result = 'Error en la Base de datos';
        }

        return $result;
    
    }

    public function updateImage($data){
        $result;

        try{
            $sql = 'CALL sp_update_user_image(:id, :image, :extension)';
            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            
            if($query->execute($data)){
                $result = true;
            }

        }catch(PDOException $e){
            $result = 'Error en la Base de datos';
        }

        return $result;
    }

    public function updatePassword($data){
        
        $result;

        try{
            $sql = 'CALL sp_update_user_password(:id, :password)';
            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            
            if($query->execute($data)){
                $result = true;
            }

        }catch(PDOException $e){
            $result = 'Error en la Base de datos';
        }

        return $result;
    
    }

    private function repeatUser($username){
        $result = false;
        try{
            $sql = 'SELECT username FROM users WHERE username = ?';

            $query = $this->db->connect()->prepare($sql);
            $query->execute([$username]);
           
            if($query->rowCount() > 0){
                $result = true;
            }

        }catch(PDOException $e){
            //echo $e;
        }

        return $result;
    }


}

?>