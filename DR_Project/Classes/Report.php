<?php

class Report {
    public $ID;
    public $date;
    public $doctorID;
    public $patientID;
    public $leftImageID;
    public $rightImageID;
    public $leftStageID;
    public $rightStageID;
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
                $this->leftImageID = new Image ($row['LeftImageID']);
                $this->rightImageID = new Image ($row['RightImageID']);
                $this->leftStageID = $row['LeftEyeStageID'];
                $this->rightStageID = $row['RightEyeStageID'];
                $this->doctorComment = $row['DoctorComment'];
                $this->isDeleted = $row['IsDeleted'];
            }
        }
    }

    public static function add($obj){
        $db = Database::getInstance();
        
        if($obj->rightImageID->ID == NULL){
            $fields = array("Date","DoctorID","PatientID","LeftImageID","LeftEyeStageID");
            $values = array($obj->date, $obj->doctorID->ID, $obj->patientID,$obj->leftImageID->ID,$obj->leftStageID);
        }
        else if($obj->leftImageID->ID == NULL){
            $fields = array("Date","DoctorID","PatientID","RightImageID","RightEyeStageID");
            $values = array($obj->date, $obj->doctorID->ID, $obj->patientID,$obj->rightImageID->ID,$obj->rightStageID);
        }
        else {
            $fields = array("Date","DoctorID","PatientID","RightImageID","LeftImageID","RightEyeStageID","LeftEyeStageID");
            $values = array($obj->date, $obj->doctorID->ID, $obj->patientID, $obj->rightImageID->ID, $obj->leftImageID->ID,$obj->rightStageID, $obj->leftStageID);
        }
        
        $db->insert("report", $fields, $values);
        return $db->Last_ID();
    }

    public static function update($obj){
        $db = Database::getInstance();
        
        if($obj->rightImageID->ID == NULL){
            $fields = array("ID","Date","DoctorID","PatientID","LeftImageID","LeftEyeStageID","DoctorComment");
            $values = array($obj->ID,$obj->date, $obj->doctorID->ID, $obj->patientID,$obj->leftImageID->ID,$obj->leftStageID,$obj->doctorComment);
        }
        else if($obj->leftImageID->ID == NULL){
            $fields = array("ID","Date","DoctorID","PatientID","RightImageID","RightEyeStageID","DoctorComment");
            $values = array($obj->ID,$obj->date, $obj->doctorID->ID, $obj->patientID,$obj->rightImageID->ID,$obj->rightStageID,$obj->doctorComment);
        }
        else {
            $fields = array("ID","Date","DoctorID","PatientID","RightImageID","LeftImageID","RightEyeStageID","LeftEyeStageID","DoctorComment");
            $values = array($obj->ID,$obj->date, $obj->doctorID->ID, $obj->patientID, $obj->rightImageID->ID, $obj->leftImageID->ID,$obj->rightStageID, $obj->leftStageID,$obj->doctorComment);
        }        
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