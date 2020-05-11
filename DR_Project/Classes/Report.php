<?php

class Report {
    public $ID;
    public $date;
    public $doctorID;
    public $patientID;
    public $imageID;
    public $stageID;
    public $doctorComment;
    public $isDeleted;

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("report", "ID=".$ID);

            if($result != NULL){
                $row = mysqli_fetch_array($result);
                $this->ID = $row['ID'];
                $this->date = $row['Date'];
                $this->doctorID = new User($row['DoctorID']);
                $this->patientID = $row['PatientID'];
                $this->imageID = $row['ImageID'];
                $this->stageID = $row['StageID'];
                $this->doctorComment = $row['DoctorComment'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $fields = array("Date","DoctorID","PatientID","ImageID","StageID","DoctorComment");
        $values = array($obj->date, $obj->doctorID, $obj->patientID, $obj->imageID, $obj->stageID, $obj->doctorComment);
        $db = Database::getInstance();
        $db->insert("report", $fields, $values);
    }

    public static function update($obj){
        $fields = array("ID","Date","DoctorID","PatientID","ImageID","StageID","DoctorComment");
        $values = array($obj->ID, $obj->date, $obj->doctorID, $obj->patientID, $obj->imageID, $obj->stageID, $obj->doctorComment);
        $db = Database::getInstance();
        $db->update("report", $fields, $values);
    }

    public static function delete($objID){
        $db = Database::getInstance();
        $db->delete("report", "ID =".$objID);
    }

    public static function view($condition){
        $db = Database::getInstance();
        $result = $db->selectWhere("report", $condition);
        $arr = array();
        $i = 0;
        if($result != NULL){
            while($row = mysqli_fetch_array($result))
            {
                $arr[$i] = new Report($row['ID']);
                $i++;
            }
            return $arr;
        }
        return NULL;
    }

}

?>