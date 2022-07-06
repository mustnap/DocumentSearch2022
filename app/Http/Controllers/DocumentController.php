<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;

use App\Actions\SaveDocumentAction;
use Illuminate\Support\Facades\Storage;


class DocumentController extends Controller
{
    private $paginationAmount = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::with('user')->paginate($this->paginationAmount);
        return view('documents.index',compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documents.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentRequest $request, SaveDocumentAction $documentAction)
    {
        $validated = $request->validate([
            'document' => 'required|mimetypes:text/plain,application/pdf'
        ]);

        $documentAction->execute($request->toArray());


        return redirect(route('documents.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentRequest  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        Storage::delete($document->location);
        $document->delete();
        return redirect(route('documents.index'));
    }


    public function search(Request $request)
    {
        $documents = Document::search($request->term)->paginate($this->paginationAmount);
        $documents->appends(['term' => $request->term]);
        return view('documents.index',compact('documents'));
    }

    
    public function download($id) 
    {
        $document = Document::findOrFail($id);
        return Storage::download($document->location, $document->filename);
    }

}
