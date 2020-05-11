<?php

class Classify {

    public static function classifyWithCNN($image) {
        $Result = shell_exec("C:\\Python37-32\\python.exe C:\Users\DELL\PycharmProjects\Python_Php\Trial3.py $image->imagePath 2>&1");
        list($Width, $Height) = explode(',', $Result);
        echo "Width Is : " . $Width;
        echo "<br><br>";
        echo "Height Is : " . $Height;
        $image->width = $Width;
        $image->height = $Height;
        Image::add($image);
    }
    
    public function retrainModel($image, $stage, $modelPath) {

    }

}

?>