<?php
namespace App\Services;
class FileService {

    /**
     * upload file in desire location with desire name
     * @param $name, $location, $file
     * @return $name
     */
    public function upload($name,$location,$file){
        $file->move(public_path($location),$name);
        return $name;
    }

    /**
     * delete image from desire location
     * @param $name, $location
     */
    public function delete($name,$location){
        unlink(public_path($location).$name);
        return back();
    }
}