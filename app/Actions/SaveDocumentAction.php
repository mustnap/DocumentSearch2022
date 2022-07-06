<?php

namespace App\Actions;

use App\Models\Document;

class SaveDocumentAction
{
    public function execute(array $upload) : bool 
    {
        $uploadedFile = $upload['document'];

        $file = $uploadedFile->store('documents');

        if(!$upload['filename']) {
            $originalFilename = basename($uploadedFile->getClientOriginalName(), '.' . $uploadedFile->getClientOriginalExtension());
        }
        
        $class = config('filereader.'.$upload['document']->getMimeType());
 
        $reader = new $class;
 
        $document = new Document();

        $document->filename = $originalFilename ?? $upload['filename'];
        $document->location = $file;

        $document->body = $reader->getContents($upload['document'])  ;
        $document->user_id = auth()->user()->id;

        $document->save();

        return true;
    }
}