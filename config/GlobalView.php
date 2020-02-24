<?php
namespace Config;

abstract class GlobalView{
    public static function as_view(){
        try {
            $num_args = func_get_args();
            $class = new \ReflectionClass(static::class);
            $method = $class->getMethods();
            if ($num_args[0]->method("post")){
                 $result = call_user_func_array([static::class,"post"],$num_args);
                 if ($result == null){
                     throw new \Exception("[POST] The Request has None response");
                 }
            }else{
                $result = call_user_func_array([static::class,"get"],$num_args);
                if ($result == null){
                    throw new \Exception("[GET] The Request has None response");
                }else{
                    return $result;
                }
            }
        } catch (\Throwable $th) {
            $string = $th->getTraceAsString();
            $line = $th->getLine();
            $code = $th->getCode();
            $file = $th->getFile();
            error_log("[{$file}][line: {$line}]".$th->getMessage(),4);
            die();
        }
    }

    public static function upload_file($dir,$file,$fileTypes=[]){
        $pathfrom = __DIR__."/../public/uploads/".$dir."/".date("Y/m/d/",time());
        $pathfrom1 = $_SERVER['REQUEST_URI']."/../public/uploads/".$dir."/".date("Y/m/d/",time());
        if (!is_dir($pathfrom) && $file != null) {
            mkdir($pathfrom, 0755, true);
        }
        $target_file = $pathfrom.basename($file['name']);
        $locatefile = $pathfrom1.basename($file['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
// Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
// Check file size
        if ($file["size"] > 500000) {
            $uploadOk = 0;
        }
// Allow certain file formats
        if (empty($fileTypes)){
            $uploadOk = 1;
        }else{
            if (in_array($imageFileType=$fileTypes)){
                $uploadOk = 1;
            }else{
                $uploadOk = 0;
            }
        }
//        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//            && $imageFileType != "gif" ) {
//
//        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $uploadOk = 0;
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }
        return [$uploadOk,$target_file,$locatefile];
    }

    public function static_url($path){
        if ($path){
            return sprintf(
                "%s://%s%s",
                isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                $_SERVER['SERVER_NAME'].":".
                $_SERVER['SERVER_PORT'],
                '/static/'.$path
            );
        }else{
            return $path;
        }

    }
}