<?php

namespace App\Http\Controllers\Admin;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MerchantController
{
    public function index()
    {
        $merchants = Merchant::orderBy('id', 'desc')->paginate(10);
        return view('admin.merchant.view', compact('merchants'));
    }

    public function create()
    {
        return view('admin.merchant.add');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['status'] = 1;
        $data['password'] = bcrypt($request->get('password'));

        if ($request->hasFile('logo')) {
            $data['logo_image'] = $request->logo->store('merchant-logos', 'public');
        }

        Merchant::create($data);
        return redirect()->route('admin.merchant.index');
    }

    public function edit(Merchant $merchant)
    {
        return view('admin.merchant.edit', compact('merchant'));
    }

    public function update(Request $request, Merchant $merchant)
    {
        $data = [];
        if($request->filled('password')){
            $data['password'] = bcrypt($request->input('password'));
        }
        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($merchant->getRawOriginal('logo_image'));
            $data['logo_image'] = $request->logo->store('merchant-logos', 'public');
        }

        $merchant->update($data);
        return redirect()->route('admin.merchant.index');

    }

    public function destroy(Merchant $merchant)
    {
        Storage::disk('public')->delete($merchant->getRawOriginal('logo_image'));
        $merchant->delete();
        return redirect()->route('admin.merchant.index');
    }

}
