<?php

namespace App\Actions;

use App\Models\Document;

class SaveDocumentAction
{
    public function execute(array $upload): bool
    {
        $uploadedFile = $upload['document'];

        $file = $uploadedFile->store('documents');

        if (!$upload['filename']) {
            $originalFilename = basename($uploadedFile->getClientOriginalName(), '.' . $uploadedFile->getClientOriginalExtension());
        }

        //  dd('filereader.'.$upload['document']->getMimeType());
        // $class = config('filereader.'.$upload['document']->getMimeType());

        // $class = config('filereader.application/pdf');
        // $class = config('filereader.text/plain');
        // $class = config('filereader.application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        // $class = config('filereader.application/vnd.openxmlformats');
        // $class = config('filereader')['application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

        $strMimeType = $upload['document']->getMimeType();
        $class = config('filereader')[$strMimeType];

        // dd($class);

        $reader = new $class;

        $document = new Document();

        $document->filename = $originalFilename ?? $upload['filename'];
        $document->location = $file;

        $document->body = $reader->getContents($upload['document']);
        $document->user_id = auth()->user()->id;

        $document->save();

        return true;
    }
}
