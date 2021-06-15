<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $searchPhrase = strtolower($request->searchPhrase);
        //dd($searchPhrase);
        $docs = DB::table('documents')->where('name', 'like', '%' . $searchPhrase . '%')->get();
        $docs = $docs->sortBy($sort);
        return view('documents', ['documents' => $docs]);
    }

    public function createUsers() {
        $mysql_host = "localhost";
        $mysql_database = "astarus";
        $mysql_user = "homestead";
        $mysql_password = "secret";
# MySQL with PDO_MYSQL
        $db = new \PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);

        $query = file_get_contents("../createUsers.sql");

        $stmt = $db->prepare($query);

        $res = $stmt->execute();

        return back()
                        ->with('res', $res);
    }

}
