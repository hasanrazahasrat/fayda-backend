<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marketing;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function index()
    {
        $marketings = Marketing ::orderBy('id', 'desc')->paginate(10);
        return view('admin.marketing.view', compact('marketings'));
    }
    public function create()
    {
        return view('admin.marketing.add');
    }

    public function store(Request $request)
    {
        $request['status'] = 1;
        $request['password'] = bcrypt($request->get('password'));
        Marketing ::create($request->all());
        return redirect()->route('admin.marketing.index');
    }

    public function edit(Marketing $marketing)
    {
        return view('admin.marketing.edit', compact('marketing'));
    }

    public function update(Request $request, Marketing $marketing)
    {
        if($request->has('password')){
            $request['password'] = bcrypt($request->get('password'));
        }
        $marketing->update($request->all());
        return redirect()->route('admin.marketing.index');

    }

    public function destroy(Marketing $marketing)
    {
        $marketing->delete();
        return redirect()->route('admin.marketing.index');
    }
}
