<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller {

    public function uploadPost(Request $request) {
        $now = \Carbon\Carbon::now();

        $request->validate([
            'document' => 'required|file|mimes:doc,docx,txt,rtf|max:2048',
            'title' => 'required'
        ]);

        $documentName = $now->timestamp . '.' . $request->document->extension();

        if (!\Illuminate\Support\Facades\File::exists(public_path("uploads"))) {
            \Illuminate\Support\Facades\File::makeDirectory(public_path("uploads"), 0777, true, true);
        }

        $request->document->move(public_path('uploads'), $documentName);

        $doc = new Document();
        $doc->name = $request->title;
        $doc->date = $now->timestamp;
        $doc->author = $request->author;
        $doc->file = $documentName;

        $doc->save();

        return back()
                        ->with('success', 'success')
                        ->with('document', $documentName);
    }

    public function list(Request $request) {
        $sort = $request->sort;
        $docs = Document::all();
        $docs = $docs->sortBy($sort);
        return view('documents', ['documents' => $docs]);
    }

    public function sortDocs(Request $request) {

    }

}
