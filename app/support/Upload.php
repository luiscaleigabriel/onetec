<?php

namespace app\support;

class Upload 
{
    private static function getFile(string $file) 
    {
        $file = $_FILES[$file]['tmp_name'];
        return $file;
    }

    public static function getNewName(string $file) 
    {
        $extension = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
        $name = uniqid() . '.' . $extension;
        return $name;
    }

    public static function uploadFile(string $file, string $path) 
    {
        $newName = self::getNewName($file);

        if(move_uploaded_file(self::getFile($file), $path . $newName)) {
            return $newName;
        }
    }

    public static function removeFile(string $path) 
    {
        if(file_exists($path)) {
            if(unlink($path)) {
                return true;
            }else {
                return false;
            }
        }
    }
}
