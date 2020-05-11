<?php
class Stage {
    public $ID;
    public $level;
    public $levelName;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("stage", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->level = $row['Level'];
                $this->LevelName = $row['LevelName'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }
    
    public static function add($obj){
        $fields = array("Level","LevelName");
        $values = array($obj->level, $obj->levelName);
        $db = Database::getInstance();
        $db->insert("stage", $fields, $values);
    }

    public static function update($obj){
        $fields = array("ID","Level","LevelName");
        $values = array($obj->ID, $obj->level, $obj->levelName);
        $db = Database::getInstance();
        $db->update("stage", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("stage", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();

        $result = $db->selectWhere("stage", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Stage($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }
}

?>