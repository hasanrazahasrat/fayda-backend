<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('merchant_id', auth('merchant')->id())->orderBy('id', 'desc')->get();
        return view('merchant.category.view', compact('categories'));
    }

    public function create()
    {
        return view('merchant.category.add');
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'title_ar',
            'points'
        ]);

        $data['merchant_id'] = auth('merchant')->id();
        if($request->hasFile('image'))
        {
            $data['images'] = $request->file('image')->store('images', 'public');
        }

        $data['status'] = $request->input('status', '0');;
        Category::create($data);

        return redirect()->route('merchant.category.index');
    }

    public function edit(Category $category)
    {
        return view('merchant.category.edit', compact('category'));
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
            Storage::disk('public')->delete($category->getRawOriginal('images'));
            $data['images'] = $request->file('image')->store('images', 'public');
        }
        $data['status'] = $request->input('status', '0');
        $category->update($data);
        return redirect()->route('merchant.category.index');
    }

    public function destroy(Category $category)
    {
        Storage::disk('public')->delete($category->getRawOriginal('images'));
        $category->delete();

        return redirect()->route('merchant.category.index');
    }
}
