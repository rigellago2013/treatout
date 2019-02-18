<?php
class User {

    protected $connection;

    public function __construct($connection) {

        $this->connection = $connection;
    }


    public function getAll() {

        $query = "SELECT * FROM users";

        $query = $this->connection->prepare($query);

        $query->execute();

        return $data =  $query->fetchAll(PDO::FETCH_OBJ);
        
    }



    public function login($email, $password) {

        session_start();

        $q = $this->connection->prepare('SELECT * FROM users WHERE email = ? AND password = ? AND is_verified = 1');

        $q->execute([$email,$password]);

        $count = $q->rowCount();


        if($count == 0) {

            return false;

        } else {


          $data = $q->fetch(PDO::FETCH_OBJ);

          $_SESSION['id'] = $data->id;
          $_SESSION['email'] = $data->email;
          $_SESSION['name'] = $data->name;
          $_SESSION['login'] = true;
          $_SESSION['is_admin'] = $data->is_admin;
    
          
          return true;

        }
        
    }


    public function getuser($id)
    {

        $q = $this->connection->prepare('SELECT * FROM users WHERE id = ?');

        $q->execute([$id]);

        $count = $q->rowCount();


        if($count == 0) {

            return false;

        } else {


          return $data = $q->fetchAll(PDO::FETCH_OBJ);

        }

    }


    public function adminlogin($email, $password) {

        session_start();

        $q = $this->connection->prepare('SELECT * FROM users WHERE email = ? AND password = ?');

        $q->execute([$email,$password]);

        $count = $q->rowCount();


        if($count == 0) {

            return false;

        } else {


          $data = $q->fetch(PDO::FETCH_OBJ);
          $_SESSION['login'] = true;
          $_SESSION['is_admin'] = 1;
          
          return true;

        }
        
    }


    public function register($name,$email,$password) {

        $stmt = $this->connection->prepare( "SELECT * FROM users WHERE email = ?" );

        $stmt->execute([$email]); 

        $res = $stmt->fetch();

        if( !$res ) {

            $data = [

                    'name' => $name,

                    'email' => $email,

                    'password' => $password,

                ];


            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";

            $stmt= $this->connection->prepare($sql);

            $res = $stmt->execute($data);


            if ($res) {


               $website = 'https://treatout.000webhostapp.com/modules/client/verify/verify.php?email='.$email;
    
               $subject = "Email verification from TreatOut!";

                $body = 
                "<html>
                <head>
                <title>TreatOut</title>
                </head>
                <body>
                <p>NOTICE: This email transmitted to ".$email." are confidential and intended for the sole use of the person to whom they are addressed.  If you are not the intended recipient you have received this email in error. 
                Any use, dissemination, forwarding, printing, copying or dealing in any way whatsoever with this email is strictly prohibited.  If you have received this email in error, please advise the sender immediately.</p>
                <table>
                <tr>
                <th> 
                     <a href='".$website."'/> Click here to verify ".$email." </a>
                </th>
                </tr>
                </table>
                </body>
                </html>";


                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <treatout.com>' . "\r\n";

                if ( mail($email,$subject,$body,$headers) ) {

                    return true;
            
                }
                    return false;

            }
                return false;


        } else  {


           return false;

        }   
        
    } //end register

    
}