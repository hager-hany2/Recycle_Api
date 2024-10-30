<?php

namespace App\Action;

use App\Models\Images;

class ImageModelSave
{
    public static function make($id,$model_name,$image_file){
        Images::query()->create(
            [
                'imageable_id' => $id,
                'imageable_type' => 'App\Models\\'.$model_name,
                'name' => $image_file,
            ]
        );
    }

}
