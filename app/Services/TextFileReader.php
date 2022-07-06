<?php

namespace App\Services;

use App\Interfaces\FileReader; 

class TextFileReader implements FileReader 
{
    public function getContents($file)
    {
        return file_get_contents($file);
    }

}