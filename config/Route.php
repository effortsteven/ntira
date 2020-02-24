<?php

namespace Config;

use Klein\Klein;

class Route
{
    public static function path($pattern, $file_location)
    {
        try {
            $klein = new Klein();
            if (preg_match("/^(?:(?:\/)?(?:.*))|(?:(?:\/))/", $pattern, $matches)) {
                $klein->respond($pattern, function ($request,$response,$service,$app) use($klein,$file_location){
                    $num_args = func_get_args();
                    return call_user_func_array([$file_location,'as_view'],$num_args);
                });
                $klein->dispatch();
            }
        } catch (\Throwable $th) {
             error_log($th->getTraceAsString(),4);
        }
    }


    public static function message($err_msg)
    {
        $klein = new Klein();
        $klein->onError(function ($klein, $err_msg) {
            $klein->service()->flash($err_msg);
            $klein->service()->back();
        });
    }

}