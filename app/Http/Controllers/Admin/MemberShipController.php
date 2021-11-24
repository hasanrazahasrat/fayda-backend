<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Membership;
use App\Models\User;
use App\Models\Tier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MemberShipController extends Controller
{
    public function index()
    {
        $members = Membership::orderBy('id', 'desc')->get();
        //$images = ItemImage::with('Item')->get();
        //dd($member);
        $tiers = Tier::all();
        return view('admin.membership.view', compact('members', 'tiers'));
    }
    public function create()
    {
        $tiers  = Tier::all();
        $users  = User::all();
        return view('admin.membership.add', compact('tiers','user'));
    }

    public function store(Request $request)
    {
       
        if($request->hasFile('badge_image') && $request->hasFile('card_image') && $request->hasFile('badge_image_sm') )
        {
            $path_badge_image       = $request->file('badge_image')->store('images');
            $path_card_image        = $request->file('card_image')->store('images');
            $path_badge_image_sm    = $request->file('badge_image_sm')->store('images');
        }
       
    
        $tier                   = new Membership;
        $tier->title            = $request->title;
        $tier->tier             = $request->tier;
        $tier->badge_image      = $path_badge_image;
        $tier->card_image       = $path_card_image;
        $tier->badge_image_sm   = $path_badge_image_sm;
        $tier->save();
        
        return redirect()->route('admin.membership.index');
    }

    public function edit(Membership $membership)
    {
        //dd("ghulam");
         $tiers  = Tier::all();
        return view('admin.membership.edit', compact('membership','tiers'));
    }

    public function update(Request $request, Membership $membership)
    {
         if($request->hasFile('badge_image') && $request->hasFile('card_image') && $request->hasFile('badge_image_sm') )
        {
            $path_badge_image       = $request->file('badge_image')->store('images');
            $path_card_image        = $request->file('card_image')->store('images');
            $path_badge_image_sm    = $request->file('badge_image_sm')->store('images');
    
        }
            $membership->badge_image      = $path_badge_image;
            $membership->card_image       = $path_card_image;
            $membership->badge_image_sm   = $path_badge_image_sm;
            // dd($membership);
        $membership->save();
        return redirect()->route('admin.membership.index');

    }

    public function destroy(Membership $membership)
    {
        $membership->delete();
        return redirect()->route('admin.membership.index');
    }
}