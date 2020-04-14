<?php

namespace classes;


class ImageManager{

    public function uploadImage(array $files) : string
    {
        if(isset($files["image"])){
            $img = $files["image"];
            $fileName = $img["name"];
            $fileSize = $img["size"];
            $fileTmp = $img["tmp_name"];
            $fileType = $img["type"];
            $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
            

            $extensions = ["jpg", "jpeg", "png"];

            if(!in_array($fileExt, $extensions)){
                throw new ImageException("Obrázek není v povoleném formátu.");
            }
            if($fileSize > 2097152){
                throw new ImageException("Obrázek je příliš velký.");
            }
            
            $fileName = uniqid("img") . ".". $fileExt;
            move_uploaded_file($fileTmp, "../images/$fileName");
            return $fileName;
        }else{
            return "";
        }
    }

    public function deleteImage(string $fileName) : void
    {
        try{
            unlink("../images/$fileName");
        }catch(\Exception $e){
            throw new ImageException($e->getMessage());
        }
        
    }
}

class ImageException extends \Exception
{}

