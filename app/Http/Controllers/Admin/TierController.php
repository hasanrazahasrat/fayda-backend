<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tier;
use Illuminate\Http\Request;

class TierController extends Controller
{
    public function index()
    {
        $tiers = Tier::orderBy('id', 'desc')->get();
        return view('admin.tier.view', compact('tiers'));
    }
    public function create()
    {
        return view('admin.tier.add');
    }

    public function store(Request $request)
    {
        $request['status'] = 1;
        Tier::create($request->all());
        return redirect()->route('admin.tier.index');
    }

    public function edit(Tier $tier)
    {
        return view('admin.tier.edit', compact('tier'));
    }

    public function update(Request $request, Tier $tier)
    {
        $tier->update($request->all());
        return redirect()->route('admin.tier.index');

    }

    public function destroy(Tier $tier)
    {
        $tier->delete();
        return redirect()->route('admin.tier.index');
    }
}
