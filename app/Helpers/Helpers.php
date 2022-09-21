<?php

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


 function findById($relations=[],$model,$params=['*'],$id)
{
    return $model::with($relations)->select($params)->findOrFail($id);


}




function storeImage($path, $file)
{
    $imageName = Str::random() . '.' . $file->getClientOriginalExtension();
    Storage::disk('public')->putFileAs($path, $file, $imageName);
    return $imageName;
}

function editImage($path, $file , $oldImage)
{
    deleteImage($oldImage);

    $imageName = Str::random() . '.' . $file->getClientOriginalExtension();
    Storage::disk('public')->putFileAs($path, $file, $imageName);
    return $imageName;
}

function deleteImage($oldImage)
{
    $exists = Storage::disk('public')->exists(substr($oldImage,8));



    if ($exists) {
        $exists = Storage::disk('public')->delete(substr($oldImage,8));
        return true;
    }
}

function getAuthspecialization($get)
{
    return auth()->guard('admin')->user()->specialization->$get;
}




