<?php
class UserType {
    public $ID;
    public $name;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("usertype", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->name = $row['Name'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }
    
    public static function add($obj){
        $fields = array("Name");
        $values = array($obj->name);
        $db = Database::getInstance();
        $db->insert("usertype", $fields, $values);
    }

    public static function update($obj){
        $fields = array("ID","Name");
        $values = array($obj->ID, $obj->name);
        $db = Database::getInstance();
        $db->update("usertype", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("usertype", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();

        $result = $db->selectWhere("usertype", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new UserType($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>