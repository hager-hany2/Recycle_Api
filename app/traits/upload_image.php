<?php

namespace App\traits;

trait upload_image
{

    public function upload($file,$folder_name){

        $valid_extensions = ['png','jpg','jpeg','svg','gif'];

        if(in_array($file->getClientOriginalExtension(),$valid_extensions)){

            $name = time().rand(0,9999999999999).'_image.'.$file->getClientOriginalExtension();
            $file->move(public_path('/images/'.$folder_name),$name);
            return $folder_name.'/'.$name;
        }

        else{
            return false;
        }
    }

}
