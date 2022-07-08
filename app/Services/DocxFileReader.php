<?php

namespace App\Services;

use App\Interfaces\FileReader;
use PhpOffice\PhpWord\PhpWord;
use \PhpOffice\PhpWord\IOFactory;

class DocxFileReader implements FileReader
{
    public function getContents($file)
    {
        // echo date('H:i:s'), " Reading contents from `{$source}`", EOL;
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($file);

        $content = "";
        // $parser = new Parser;
        // $contents = $parser->parseFile($file);
        // return $contents->getText();

        // dd($phpWord);

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getElements')) {
                    foreach ($element->getElements() as $childElement) {
                        if (method_exists($childElement, 'getText')) {
                            $content .= $childElement->getText() . ' ';
                        } else if (method_exists($childElement, 'getContent')) {
                            $content .= $childElement->getContent() . ' ';
                        }
                    }
                } else if (method_exists($element, 'getText')) {
                    $content .= $element->getText() . ' ';
                }
            }
        }

        dd($content);

        return $content;
    }
}
