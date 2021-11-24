<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\itemimage;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.view', compact('categories'));
    }
    public function create()
    {
        return view('admin.category.add');
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'title_ar',
            'points'
        ]);

        if($request->hasFile('image'))
        {
            $data['images'] = $request->file('image')->store('images', 'public');
        }

        $data['status'] = 1;
        $category = Category::create($data);

        return redirect()->route('admin.category.index');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->only([
            'title',
            'title_ar',
            'points'
        ]);

        if($request->hasFile('image'))
        {
            $currentFile = \Str::after($category->images, 'storage/');
            logger("deleting currentFile: $currentFile");
            \Storage::disk('public')->delete(\Str::after($category->images, 'storage/'));
            $data['images'] = $request->file('image')->store('images', 'public');

            logger('new file ' . $data['images']);
        }

        $category->update($data);

        return redirect()->route('admin.category.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index');
    }
}
