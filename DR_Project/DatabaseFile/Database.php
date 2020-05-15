<?php

class Database{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $conn;
    public static $instance;

    private function __construct($sn , $us , $pw , $dbn){
        $this->servername = $sn;
        $this->username = $us;
        $this->password = $pw;
        $this->dbname = $dbn;
        if(self::$instance == NULL){
            self::$instance = $this;
            $this->startConnection();
        }
    }

    function startConnection(){
        if($this->conn == NULL){
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        }

        if(!$this->conn){
            //echo "Database Connection Failed";
        }
        else{
            //echo "Database Connection Succeeded";
        }
    }

    public static function getInstance(){
        if(self::$instance == NULL){
            $db = new Database("localhost", "root", "", "dr_project");
        }
        return self::$instance;
    }

    function selectWhere($tableName , $condition){
        $sql = "select * from ".$tableName." where ".$condition." and IsDeleted = 0";
        $result = mysqli_query($this->conn, $sql);
        
        //echo $sql;
        //echo "<br>";

        if($result){
            if(mysqli_num_rows($result) > 0){
                return $result;
            }
            else{
                return NULL;
            }
        }
    }

    function insert($tableName , $fieldsName , $data){
        $fields = "";
        $values = "";
        for($i = 0 ; $i < count($fieldsName) ; $i++){
            $fields = $fields.$fieldsName[$i].",";
            $values = $values."'".$data[$i]."',";
        }

        $fields = substr($fields , 0 , strlen($fields) - 1);
        $values = substr($values , 0 , strlen($values) - 1);

        $sql = "insert into ".$tableName." (".$fields.") values (".$values.") "; 
//       echo "Sql = ".$sql."<br>";
        
        if(mysqli_query($this->conn, $sql)){
            //echo "Insertion Succeeded";
            return true;
        }
        else{
            //echo "Insertion Failed";
            return false;
        }
    }

    function update($tableName, $fieldsName , $data){
        $sqlConcat = "";
        for($i = 0 ; $i < count($fieldsName) ; $i++){
            $sqlConcat = $sqlConcat."".$fieldsName[$i]."='".$data[$i]."',";
        }

        $sqlConcat = substr($sqlConcat , 0 , strlen($sqlConcat) - 1);

        $sql = "update ".$tableName." set ".$sqlConcat." where ID= ".$data[0].""; 
//        echo "Sql = ".$sql."<br>";

        if(mysqli_query($this->conn, $sql)){
            //echo "Update Succeeded";
            return true;
        }
        else{
            //echo "Update Failed";
            return false;
        }
    }

    function delete($tableName , $condition){
        $sql = "update ".$tableName." set IsDeleted = 1 where ".$condition.""; 
        //echo "Sql = ".$sql;
        
        if(mysqli_query($this->conn, $sql)){
            //echo "Deletion Succeeded";
            return true;
        }
        else{
            //echo "Deletion Failed";
            return false;
        }
    }

    function Last_ID()
    {
        $SQL = "SELECT LAST_INSERT_ID()";
        $Result = mysqli_query($this->conn, $SQL);
        $Row = mysqli_fetch_array($Result);
        $ID = $Row[0];
        return $ID;
    }

    function Count($tableName , $condition){
        $sql = "select Count(*) num from ".$tableName." where ".$condition." and IsDeleted = 0";
        $result = mysqli_query($this->conn, $sql);
        //echo $sql;

        if(mysqli_num_rows($result) > 0)
        {
            return $result;
        }
        else
        {
            return NULL;
        }
    }

    function closeConnection(){
        $this->conn->close();
    }
}
?>