<?php

//Validate class is used for input data validation when it comes to reading XML files

class Validate {

    var $fileError;

    function Validate() {
        $this->fileError = "";
    }

    public function isFileEmpty($file) { 
        return $file["error"] !== 0;
    }

    public function validateFile($file) {    
        $target_dir = "uploads/";
        $fileName = preg_replace("/[^a-zA-Z0-9.]/", "", basename($file["name"]));
        $target_file = $target_dir . $fileName;
        $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check file size
    //REMEBER TO CHANGE THE upload_max_filesize VAR IN PHP.INI
        if ($file["size"] > 5000000) {
            $this->fileError = "El archivo es muy grande.";
            return false;
        }
    // Allow certain file formats
        if(strcmp($fileType, "xml") !== 0) {
            $this->fileError = "Sólo se permiten archivos XML";
            return false;
    }           // update data
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return true;
    }else{
        return false;
    }
}

public function getFileError() {  
    return ($this->fileError)."";
}
}
?>