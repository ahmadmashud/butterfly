<?php

namespace App\Helpers;

class File
{
    
    public static function uploadSingleFile($file, $folderDestination = NULL): string
    {
        $originalNameWithExt = $file->getClientOriginalName();
        $originalName = pathinfo($originalNameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filename = $originalName . '_' . time() . '.' . $extension;
        $file->storeAs('public' . $folderDestination, $filename);
        return $filename;
    }

    public static function uploadSingleFileV2($file, $folderDestination = NULL): string
    {

        $originalNameWithExt = $file->getClientOriginalName();
        $originalName = pathinfo($originalNameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filename = $originalName . '_' . time() . '.' . $extension;
        $file->storeAs($folderDestination,$filename,'public_folder');
        return $filename;
    }
}
