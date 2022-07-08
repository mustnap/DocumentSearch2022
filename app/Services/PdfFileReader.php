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



        // $class = config('filereader.application/pdf');
        // $class = config('filereader.text/plain');
        // $class = config('filereader.application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        $class = config('filereader.application/vnd.openxmlformats');