<?php
class Classify {

    public static function classifyWithCNN($image) {
        $PythonVersion = "C:\\Python37\\python.exe";
        $File = "C:\xampp\htdocs\DR_Project\Python\classify.py";
        
        $Result = shell_exec("$PythonVersion $File $image 2>&1");
        $FinalResult = explode(",", $Result);
                
        return $FinalResult;
    }
    
    public function retrainModel($image, $stage, $modelPath) {

    }

}

?>