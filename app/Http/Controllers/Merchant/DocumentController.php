<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('merchant.documents.view', compact('documents'));
    }
    public function create()
    {
        $documents = Document::all();
        return view('merchant.documents.add', compact('itemPromotions','documents'));
    }

    public function store(Request $request)
    {
        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('images');
        }

        $Document                  = new Document;
        $Document->title     = $request->title;
        $Document->image          = $path;
        $Document->status = 1;
        $Document->save();
        return redirect()->route('merchant.document.index');
    }

    public function edit($id)
    {
        $document = Document::find($id);
        $categories = Document::all();
        return view('merchant.documents.edit', compact('document','categories'));
    }

    public function update(Request $request, Document $document)
    {
        $document->update($request->all());
        return redirect()->route('merchant.document.index');

    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('merchant.document.index');
    }
}