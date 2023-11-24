<?php

class FileManager
{

    public static function getArray($file)
    {
        $json = file_get_contents($file);
        $array = json_decode($json, true);
        return $array;
    }

    public static function save($array, $file)
    {
        $newJson = json_encode($array, JSON_UNESCAPED_UNICODE);
        file_put_contents($file, $newJson);
        unset($_POST);
        header('Location: /');
    }

    public static function test_save($array, $file)
    {
        $newJson = json_encode($array, JSON_UNESCAPED_UNICODE);
        file_put_contents($file, $newJson);
        unset($_POST);
    }

}
