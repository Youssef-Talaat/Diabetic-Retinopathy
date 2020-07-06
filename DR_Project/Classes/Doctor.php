<?php

class Doctor extends User {

    public function viewPatients($condition) {
        return User::view($condition);
    }

    public function uploadImage($LeftObject) {
        return Image::add($LeftObject);
    }

    public function classify($imagePath) {
        return Classify::classifyWithCNN($imagePath);
    }

    public function createReport($report) {
        return Report::add($report);
    }

    public function viewReport($patientID) {
        return Report::view($patientID);
    }

}

?>