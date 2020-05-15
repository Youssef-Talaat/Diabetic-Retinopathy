<?php

class Preprocess {

    public static function normalize($image) {
        $PythonVersion = "C:\\Python36\\python.exe";
        $File = "C:\wamp64\www\DR_Project\Python\Normalize.py";
        
        $Result = shell_exec("$PythonVersion $File $image 2>&1");
        
        echo var_dump($Result);
    }
}

?>