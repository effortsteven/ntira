<?php
namespace Config\Core;
  class FileManager {
    /*
    ** This function upload only a single file from the request
    */
    public static function uploadSingleFile($path, $resource){

        $current_dir = __DIR__."/../../static/";
        $data_to_append = ((string)(round(microtime(true) * 1000)))
            .str_replace('.','-',uniqid('78442',true))."."
            .pathinfo(basename($_FILES[$resource]["name"]), PATHINFO_EXTENSION);
        $fileName = $current_dir.$path.$data_to_append;
        $fileName1 = $path.$data_to_append;
        error_log($_FILES[$resource]["type"],4);
        $check = getimagesize($_FILES[$resource]["tmp_name"]);
        if($check !== false) {
            if (self::compress($_FILES[$resource]["tmp_name"],$fileName,80)){
                return $fileName1;
            }
        } else {
            if (move_uploaded_file($_FILES[$resource]["tmp_name"],$fileName)){
                return $fileName1;
            }
        }

//        return null;
    }
    /*
    ** This function upload multiple files while returning the url
    */
     public static function doTheUPloadMultiple($path,$names){
        $resources = $_FILES[$names];
        $resourcesList = array();
        $fileCount = count($resources);
        if ($fileCount>0) {
              for ($i=0;$i<$fileCount;$i++) {
                    $name=$path.((string)(round(microtime(true) * 1000)))
                    .str_replace('.','-',uniqid('78442',true))."."
                    .pathinfo(basename($resources['name'][$i]), PATHINFO_EXTENSION);
                    if(!(move_uploaded_file($resources['tmp_name'][$i],$name))){
                              foreach ($resourcesList as $resource) {
                                  self::deleteFile($path);
                              }
                              return false;
                     }
                    $resourcesList[]=$name;
              }
        }else{
          return null;
        }
        return $resourcesList;
     }
     /*
     ** This static function serves as a file deleter
     */
     public static function deleteFile($filePath){
         $current_dir = __DIR__."/../../static/";
       if( unlink($current_dir.$filePath) ) {
          return true;
       }
       return false;
     }

     public static function compress_image($source_file, $target_file, $nwidth, $nheight, $quality) {
         //Return an array consisting of image type, height, widh and mime type.
         $image_info = getimagesize($source_file);
         if ($image_info !== false){
             if(!($nwidth > 0)) $nwidth = $image_info[0];
             if(!($nheight > 0)) $nheight = $image_info[1];

             if(!empty($image_info)) {
                 switch($image_info['mime']) {
                     case 'image/jpeg' :
                         if($quality == '' || $quality < 0 || $quality > 100) $quality = 75; //Default quality
                         // Create a new image from the file or the url.
                         $image = imagecreatefromjpeg($source_file);
                         $thumb = imagecreatetruecolor($nwidth, $nheight);
                         //Resize the $thumb image
                         imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);
                         //Output image to the browser or file.
                         return imagejpeg($thumb, $target_file, $quality);

                         break;

                     case 'image/png' :
                         if($quality == '' || $quality < 0 || $quality > 9) $quality = 6; //Default quality
                         // Create a new image from the file or the url.
                         $image = imagecreatefrompng($source_file);
                         $thumb = imagecreatetruecolor($nwidth, $nheight);
                         //Resize the $thumb image
                         imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);
                         // Output image to the browser or file.
                         return imagepng($thumb, $target_file, $quality);
                         break;

                     case 'image/gif' :
                         if($quality == '' || $quality < 0 || $quality > 100) $quality = 75; //Default quality
                         // Create a new image from the file or the url.
                         $image = imagecreatefromgif($source_file);
                         $thumb = imagecreatetruecolor($nwidth, $nheight);
                         //Resize the $thumb image
                         imagecopyresized($thumb, $image, 0, 0, 0, 0, $nwidth, $nheight, $image_info[0], $image_info[1]);
                         // Output image to the browser or file.
                         return imagegif($thumb, $target_file, $quality); //$success = true;
                         break;

                     default:
                         return move_uploaded_file($source_file, $target_file);
                         break;
                 }
             }
         }else{
             return move_uploaded_file($source_file, $target_file);
         }

     }

      public static function url(){
          return sprintf(
              "%s://%s%s",
              isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
              $_SERVER['SERVER_NAME'],
              $_SERVER['REQUEST_URI']
          );
      }

      public static function compress($source, $destination, $quality) {
            error_log($source,4);
          try{
              $info = getimagesize($source);

              if ($info['mime'] == 'image/jpeg')
                  $image = imagecreatefromjpeg($source);

              elseif ($info['mime'] == 'image/gif')
                  $image = imagecreatefromgif($source);

              elseif ($info['mime'] == 'image/png')
                  $image = imagecreatefrompng($source);

              imagejpeg($image, $destination, $quality);
              return true;
          }catch (\Exception $e){
              return false;
          }
      }
  }
?>
