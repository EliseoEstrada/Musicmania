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
                'rol'       => 0,
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
            $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';
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
                    'rol'        => $row['rol'],
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

    public function repeatUser($username){
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