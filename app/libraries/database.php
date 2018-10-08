<?php 

    /**this is our database class 
     * Connect to the database 
     * create prepared statments 
     * bind values 
     * return the query result 
     */

    class Database {
        private $host   = DB_HOST;
        private $user   = DB_USER;
        private $pass   = DB_PASS;
        private $dbName = DB_NAME;

        private $dbh; // database handler 
        private $stmt ;
        private $error ;


        public function __construct(){
            
            // set DSN 
            $dsn = 'mysql:host='.$this->host . ';dbname='.$this->dbName;
            $options = array(
                PDO::ATTR_PERSISTENT=> true ,
                PDO:: ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
            );

            //Create PDO Instance 

            try {
                
                $this->dbh = new PDO($dsn,$this->user,$this->pass,$options);
            }catch(PDOException $err){
                $this->error = $err->getMessage(); 
                echo $this->error;
            }
        }


        // prepare SQL Query
        public function query($sql){
            $this->stmt = $this->dbh->prepare($sql);
        }

        // Bind Value 
        public function bind($param,$value,$type=null){
            if(is_null($type)){

                switch(true){

                    case is_int($value):
                        $type =PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($type):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO:: PARAM_STR;
                }
            }

            $this->stmt->bindValue($param,$value,$type);
        }

        // Execute the prepared Statement 
        public function execute(){
            return $this->stmt->execute();
        }

        // Get the result as array of objects 

        public function resultSet(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }
        // Get Single Row 
        public function single(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        //Get Row Count 

        public function rowCount(){
            return $this->stmt->rowCount();
        }

    }

?>