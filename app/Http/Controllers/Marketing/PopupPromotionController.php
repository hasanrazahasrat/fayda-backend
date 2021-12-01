<?php


namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\PopupPromotion;
use App\Models\ItemPromotion;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\ItemImage;

class PopupPromotionController
{
	public function index()
    {
    	$ppros = ItemPromotion::all();
        return view('marketing.popup-promotion.view', compact('ppros'));
    }
    public function create()
    {
        return view('marketing.popup-promotion.add');
    }

    public function store(Request $request)
    {
        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('images');
        }

        $ItemPromotion                  = new ItemPromotion;
        $ItemPromotion->p_category = '0';
        $ItemPromotion->promotion_date      = $request->promotion_date;
        $ItemPromotion->item            = $request->item;
        $ItemPromotion->ip_detail      = $request->ip_detail;
        $ItemPromotion->image          = $path;
        $ItemPromotion->save();
        return redirect()->route('marketing.popup_promotion.index');
    }

    public function edit($id)
    {
        $ppro = ItemPromotion::find($id);
        return view('marketing.popup-promotion.edit', compact('ppro' ));
    }

    public function update(Request $request, $id)
    {
        $item = ItemPromotion::find($id);
        if($request->hasFile('image'))
        {
            Storage::disk('public')->delete($item->getRawAttribute('image'));
            $item->image = $request->file('image')->store('images');
        }
        $item->promotion_date      = $request->promotion_date;
        $item->item            = $request->item;
        $item->ip_detail      = $request->ip_detail;
        $item->save();
        return redirect()->route('marketing.popup_promotion.index');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('marketing.item.index');
    }
}
