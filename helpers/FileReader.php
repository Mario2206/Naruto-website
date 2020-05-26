<?php
namespace Helper;
/**
 * Class for checking file
 */
class FileReader {

    private $ext_img = ["jpg", "png"];
    private $current_ext = "";
    private $dir ="img_uploaded/";
    private $fileName = "fileName";
    private $urlFile = "";
    private $state = true;
    const MAX_SIZE = 100000000;

    /**
     * method for checking if the file is an image
     * 
     * @param array $file
     * 
     * !return bool status
     */
    public function getImage(array $file) :bool {
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
        if($file["size"] > self::MAX_SIZE) {
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

    /**
     * to get direction file url
     * 
     * !return string
     */
    public function getUrl() {
        return $this->state ? $this->urlFile : "";
    }

    public function defineDir(string $dir) {
        $this->dir = $dir;
    }

    private function cryptName($name) {//Crypt the name enables to conserv every file and to avoid overwriting  
        return hash("sha512", $name).".".$this->current_ext;
    }
}