<?php

class User {
    public $ID;
    public $fullName;
    public $DOB;
    public $links; //array
    public $username;
    public $password;
    public $email;
    public $telephone;
    public $userTypeID;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("user", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->fullName = $row['FullName'];
                $this->DOB = $row['DOB'];
                $this->username = $row['Username'];
                $this->password = $row['Password'];
                $this->email = $row['Email'];
                $this->telephone = $row['Telephone'];
                $this->userTypeID = new UserType($row['UserTypeID']);
                $this->isDeleted = $row['IsDeleted'];

                $result = $db->selectWhere("permission", "UserTypeID=".$this->userTypeID->ID);
                if($result != NULL){
                    $this->links = array();
                    $i = 0;
                    while($row = mysqli_fetch_array($result))
                    {
                        $this->links[$i] = new Link($row['LinkID']);
                        $i++;
                    }
                }

            }
        }
    }

    public static function add($obj){
        $fields = array("FullName","DOB","Email","Telephone","Username","Password","UserTypeID");
        $values = array($obj->fullName, $obj->DOB, $obj->email, $obj->telephone, $obj->username, $obj->password, $obj->userTypeID);
        $db = Database::getInstance();
        $db->insert("user", $fields, $values);
    }

    public static function update($obj){
        $fields = array("ID","FullName","DOB","Email","Telephone","Username","Password","UserTypeID");
        $values = array($obj->ID, $obj->fullName, $obj->DOB, $obj->email, $obj->telephone, $obj->username, $obj->password, $obj->userTypeID);
        $db = Database::getInstance();
        $db->update("user", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("user", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("user", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new User($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }

    public static function logIn($username , $password){
        $db = Database::getInstance();
        $result = $db->selectWhere("user", "Username = '".$username."' and Password = '".sha1($password)."'");

        if($result != NULL){
            $row = mysqli_fetch_array($result);
            return new User($row['ID']);
        }
        else{
            return NULL;
        }
    }

}

?>