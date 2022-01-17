
<?php

spl_autoload_register('myAutoloder');

function myAutoloder($className)
{
    $path = "../objects/"; //"objects/";
    $extension = ".php";
    $fullPath = $path . $className . $extension;

    if (!file_exists($fullPath)) {
        return false;
    }


    include_once $fullPath;
}
