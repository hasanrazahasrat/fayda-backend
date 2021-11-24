<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('admin.documents.view', compact('documents'));
    }
    public function merchant_index()
    {
        $documents = Document::all();
        return view('admin.documents.merchant_view', compact('documents'));
    }
    public function show()
    {
        $documents = Document::all();
        return view('admin.documents.merchant_view', compact('documents'));
    }
    public function create()
    {
        return view('admin.documents.add');
    }

    public function store(Request $request)
    {
        $request['status'] = 1;
        Document::create($request->all());
        return redirect()->route('admin.document.index');
    }

    public function edit(Document $document)
    {
        return view('admin.documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $document->update($request->all());
        return redirect()->route('admin.document.index');

    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('admin.document.index');
    }
}
