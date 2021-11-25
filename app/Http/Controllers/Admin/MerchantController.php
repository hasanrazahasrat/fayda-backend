<?php

namespace App\Http\Controllers\Admin;

use App\Models\Merchant;
use Illuminate\Http\Request;

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
        $request['status'] = 1;
        $request['password'] = bcrypt($request->get('password'));
        Merchant::create($request->all());
        return redirect()->route('admin.merchant.index');
    }

    public function edit(Merchant $merchant)
    {
        return view('admin.merchant.edit', compact('merchant'));
    }

    public function update(Request $request, Merchant $merchant)
    {
        if($request->has('password')){
            $request['password'] = bcrypt($request->get('password'));
        }
        $merchant->update($request->all());
        return redirect()->route('admin.merchant.index');

    }

    public function destroy(Merchant $merchant)
    {
        $merchant->delete();
        return redirect()->route('admin.merchant.index');
    }

}
