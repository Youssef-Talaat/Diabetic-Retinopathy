<?php
class Image {
    public $ID;
    public $width;
    public $height;
    public $imagePath;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("image", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->width = $row['Width'];
                $this->height = $row['Height'];
                $this->imagePath = $row['ImagePath'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }
    
    public static function add($obj){
        $fields = array("Width","Height","ImagePath");
        $values = array($obj->width, $obj->height, $obj->imagePath);
        $db = Database::getInstance();
        $db->insert("image", $fields, $values);
    }

    public static function update($obj){
        $fields = array("ID","Width","Height","ImagePath");
        $values = array($obj->ID, $obj->width, $obj->height, $obj->imagePath);
        $db = Database::getInstance();
        $db->update("image", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("image", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();

        $result = $db->selectWhere("image", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Image($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>