<?php

return [
    'text/plain' => App\Services\TextFileReader::class,
    'application/pdf' => App\Services\PdfFileReader::class,
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => App\Services\DocxFileReader::class
];

 