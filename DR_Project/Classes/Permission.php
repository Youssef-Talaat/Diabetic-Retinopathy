<?php
class Permission {
    public $ID;
    public $linkID;
    public $userTypeID;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("permission", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->linkID = $row['LinkID'];
                $this->userTypeID = $row['UserTypeID'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }
    
    public static function add($obj){
        $fields = array("LinkID", "UserTypeID");
        $values = array($obj->linkID, $obj->userTypeID);
        $db = Database::getInstance();
        $db->insert("permission", $fields, $values);
    }

    public static function update($obj){
        $fields = array("ID", "LinkID", "UserTypeID");
        $values = array($obj->ID, $obj->linkID, $obj->userTypeID);
        $db = Database::getInstance();
        $db->update("permission", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("permission", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();

        $result = $db->selectWhere("permission", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Permission($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>