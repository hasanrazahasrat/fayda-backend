<?php


namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\PromotionsItem;
use App\Models\PromotionsCategory;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\ItemImage;

class ItemPromotionController extends Controller
{
    public function index()
    {
        $categories = PromotionsCategory::all();
        $itemPromotions = PromotionsItem::with('PromotionsCategory')->get();
        return view('marketing.item-wise-promotion.view', compact('itemPromotions','categories'));
    }
    public function create()
    {

        $categories = PromotionsCategory::all();
        $marketings = Merchant::all();
        $items = Item::all();
        return view('marketing.item-wise-promotion.add',compact('categories', 'marketings', 'items'));
    }

    public function store(Request $request)
    {
        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('images');
        }

        $ItemPromotion                  = new PromotionsItem;
        $ItemPromotion->promotions_category_id      = $request->promotions_category_id;
        $ItemPromotion->title            = $request->item;
        $ItemPromotion->description       =$request->ip_detail;
        $ItemPromotion->image          = $path;
        $ItemPromotion->save();

        return redirect()->route('marketing.item_promotion.index');
    }

    public function edit($item_promotion)
    {
        $ipro = PromotionsItem::find($item_promotion);
        $categories = PromotionsCategory::all();

        return view('marketing.item-wise-promotion.edit', compact('categories','ipro' ));
    }

    public function update(Request $request, $item_promotion)
    {
        $item = PromotionsItem::find($item_promotion);
        if($request->hasFile('itemimage'))
        {
            Storage::disk('public')->delete($item->getRawAttribute('image'));
            $item->image = $request->file('itemimage')->store('images');
        }

        $item->promotions_category_id      = $request->promotions_category_id;
        $item->title            = $request->item;
        $item->description       =$request->description;
        $item->save();
        return redirect()->route('marketing.item_promotion.index');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('marketing.item.index');
    }
}
