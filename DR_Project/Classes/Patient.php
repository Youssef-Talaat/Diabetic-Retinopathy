<?php

class Patient extends User {
    public $reports; //array

    public function __construct($ID){
        if($ID != 0){
            $db = Database::getInstance();
            $result = $db->selectWhere("report", "PatientID=".$ID);
            if($result != NULL){
                $this->reports = array();
                $i = 0;
                while($row = mysqli_fetch_array($result))
                {
                    $this->reports[$i] = new Report($row['ID']);
                    $i++;
                }
            }
            parent::__construct($ID);
            }
    }

    public function viewReports() {

    }

}

?>