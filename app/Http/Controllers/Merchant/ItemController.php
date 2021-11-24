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
        $items = Item::with('category')->get();
        return view('merchant.items.view', compact('items'));
    }
    public function create()
    {
        $categories = Category::all();
        $RoyalityPoint = RoyalityPoint::all();
        return view('merchant.items.add', compact('categories','RoyalityPoint'));
    }

    public function store(Request $request)
    {
        // $request['status'] = 1;
        // Item::create($request->all());
        $files = $request->image;
        $images = [];
        foreach($files as $file)
        {
            $images[]['image'] = $file->store('images');
        }
        $u_data =session()->all();
        
        $request['status'] = 1;
        $request['user_id'] = $u_data['login_merchant_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
        $request['user_type'] = 'merchant';
        Item::create($request->except('image'))->images()->createMany($images);
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
        $ItemImages = ItemImage::all();
        foreach($ItemImages as $ItemImage)
        {
            
            if($ItemImage->item_id == $item->id)
            { 
                ItemImage::where('item_id', $item->id)->delete();
            }
        }
       
        $files = $request->image;
        foreach($files as $file)
        {
         
            $images = $file->store('images');
            //ItemImage::where('item_id',$item->id)->update(['image' => $images ]);
            //ItemImage::where('item_id', $item->id)->firstorfail()->delete();
            
            $data[] = [
            'image' => $images,
            'item_id' => $item->id,
            'updated_at' => date('Y-m-d'),
            ];
               
        }

          ItemImage::insert($data);

        
        $item->update($request->all());
        return redirect()->route('merchant.item.index');

    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('merchant.item.index');
    }
}
