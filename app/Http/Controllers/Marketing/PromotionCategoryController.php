<?php


namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\PromotionsCategories;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\ItemImage;

class PromotionCategoryController extends Controller
{
    public function index()
    {
        $itemPromotions = ItemPromotion::all();
        return view('marketing.category.view', compact('itemPromotions'));
    }
    public function create()
    {
        return view('marketing.category.add');
    }

    public function store(Request $request)
    {
         $request->validate([
            'title' => 'required',
        ]);

        PromotionsCategories::create([
            'title' => request()->get('title'),
        ]);
        return redirect()->route('marketing.item_promotion.create');
    }

    // public function edit(Item $item)
    // {
    //     $categories = Category::all();
    //     return view('marketing.item-wise-promotion.edit', compact('item', 'categories'));
    // }

    // public function update(Request $request, Item $item)
    // {
    //     $item->update($request->all());
    //     return redirect()->route('marketing.item.index');

    // }

    // public function destroy(Item $item)
    // {
    //     $item->delete();
    //     return redirect()->route('marketing.item.index');
    // }
}
