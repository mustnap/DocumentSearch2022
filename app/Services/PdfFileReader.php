<?php

namespace App\Services;

use App\Interfaces\FileReader; 
use Smalot\PdfParser\Parser;

class PdfFileReader implements FileReader 
{
    public function getContents($file)
    {
        $parser = new Parser;
        $contents = $parser->parseFile($file);
        return $contents->getText();
    }

}