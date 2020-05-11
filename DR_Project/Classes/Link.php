<?php
class Link{
    public $ID;
    public $physicalAddress;
    public $friendlyName;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("link", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->physicalAddress = $row['PhysicalAddress'];
                $this->friendlyName = $row['FriendlyName'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($l){
        $fields = array("ID","PhysicalAddress","FriendlyName");
        $values = array($l->ID, $l->physicalAddress, $l->friendlyName, $l->icon);
        $db = Database::getInstance();
        $db->insert("link", $fields, $values);
    }

    public static function update($ly){
        $fields = array("ID","PhysicalAddress","FriendlyName");
        $values = array($l->ID, $l->physicalAddress, $l->friendlyName, $l->icon);
        $db = Database::getInstance();
        $db->update("link", $fields, $values);
    }

    public static function delete($lID){
        $db = Database::getInstance();
        $db->delete("link", "ID =".$lID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("link", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Link($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>