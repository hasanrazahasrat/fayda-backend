<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\RoyalityPoint;
use App\Models\ItemImage;
use App\Models\Admin;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        $merchants = Merchant::all();
        $items = Item::with('category')->orderBy('id', 'desc')->get();
        $images = ItemImage::with('Item')->get();
        return view('admin.items.view', compact('items','images','admins','merchants'));
    }
    public function create()
    {
        $categories = Category::all();
        $RoyalityPoint = RoyalityPoint::all();
        return view('admin.items.add', compact('categories','RoyalityPoint'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name_ar' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        $u_data = session()->all();

        $files = $request->image;
        $images = [];
        foreach(($files ?? []) as $file)
        {
            $images[]['image'] = $file->store('images', 'public');
        }
        
        $request['status'] = 1;
        $request['user_id'] = $u_data['login_admin_59ba36addc2b2f9401580f014c7f58ea4e30989d'];
        $request['user_type'] = 'admin';
        Item::create($request->except('image'))->images()->createMany($images);
        
        return redirect()->route('admin.item.index');
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        $RoyalityPoint = RoyalityPoint::all();
        $item->loadMissing('category');
        return view('admin.items.edit', compact('item', 'categories','RoyalityPoint'));
    }

    public function update(Request $request, Item $item)
    {
        if($request->hasFile('image'))
        {
            $item->images()->delete();
           
            $files = $request->image;
            foreach($files as $file)
            {
                $images = $file->store('images', 'public');
                logger('saving item image : ' . $images);
                $data[] = [
                    'image' => $images,
                    'item_id' => $item->id,
                    'updated_at' => date('Y-m-d'),
                ];
            }

            ItemImage::insert($data);
        }
        
        $item->update($request->all());
        return redirect()->route('admin.item.index');

    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('admin.item.index');
    }
}
