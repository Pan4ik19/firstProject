<?php



class Autoloader
{
    public  static function registate($dir)
    {
        $autoLoaderController = function ($className) use ($dir){

            $className = str_replace('\\',DIRECTORY_SEPARATOR,$className);
            $fileName = $dir."/".$className.".php";
            if(file_exists($fileName))
            {
                require_once $fileName;
                return true;
            }
            return false;
        };
        spl_autoload_register($autoLoaderController);
    }
}