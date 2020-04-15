<?php
namespace Model;
class FileReader {

    private $ext_img = ["jpg", "png"];
    private $current_ext = "";
    private $dir = "public/img_uploaded/";
    private $fileName = "fileName";
    private $urlFile = "";
    private $state = true;
    private $MAX_SIZE = 100000000;

    public function getImage($file) {
        $this->fileName = $file["name"];
        //Check if the file is an image
        if(!getImageSize($file['tmp_name'])) {
            $this->state = false;
        } 
        //Check img extension
        $this->current_ext = strtolower(pathinfo($this->fileName, PATHINFO_EXTENSION));
        if(!in_array($this->current_ext, $this->ext_img)) {
            $this->state = false;
        }
        //check img size
        if($file["size"] > $this->MAX_SIZE) {
            $this->state = false;
        }
        //check if the file already exists
        $fileNameCrypt = $this->fileName;
        do{
            $fileNameCrypt = $this->cryptName($fileNameCrypt);
            $this->urlFile = $this->dir.$fileNameCrypt;
        }while(file_exists($this->urlFile));
            
        //Send img
        if($this->state) {
            return $this->state = move_uploaded_file($file["tmp_name"], $this->urlFile);
        } else {
            return false;
        }
    }

    public function getUrl() {
        return $this->state ? $this->urlFile : "";
    }

    private function cryptName($name) {//Crypt the name enables to conserv every file and to avoid overwriting  
        return hash("sha512", $name).".".$this->current_ext;
    }
}