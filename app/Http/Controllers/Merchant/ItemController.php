<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\RoyalityPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\ItemImage;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category', 'images')->get();
        return view('merchant.items.view', compact('items'));
    }
    public function create()
    {
        $categories = Category::where('merchant_id', auth('merchant')->id())->get();
        $RoyalityPoint = RoyalityPoint::all();

        return view('merchant.items.add', compact('categories','RoyalityPoint'));
    }

    public function store(Request $request)
    {
        $itemData = $request->except('_token', 'image');
        $itemData['user_id'] = auth('merchant')->id();
        $itemData['user_type'] = 'merchant';
        $itemData['status'] = 1;

        $item = Item::create($itemData);
        if ($request->hasFile('image')) {
            $images = [];
            foreach ($request->file('image') as $image) {
                $images[] = [
                    'image' => $image->store('product-images', 'public')
                ];
            }

            $item->images()->createMany($images);
        }

        return redirect()->route('merchant.item.index');
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        $RoyalityPoint = RoyalityPoint::all();
        return view('merchant.items.edit', compact('item', 'categories', 'RoyalityPoint'));
    }

    public function update(Request $request, Item $item)
    {
        $itemData = $request->except('_token', 'image');
        $item->update($itemData);

        if ($request->hasFile('image')) {
            $images = [];
            foreach ($request->file('image') as $image) {
                $images[] = [
                    'image' => $image->store('product-images', 'public')
                ];
            }

            foreach ($item->images as $image) {
                Storage::disk('public')->delete($image->getRawOriginal('image'));
            }
            $item->images()->delete();
            $item->images()->createMany($images);
        }

        return redirect()->route('merchant.item.index');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('merchant.item.index');
    }
}
