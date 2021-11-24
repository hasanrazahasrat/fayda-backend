<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class usercont extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.view', compact('users'));
    }
    public function create()
    {
        return view('admin.user.add');
    }

    public function store(Request $request)
    {
        $request['status'] = 1;
        $request['password'] = bcrypt($request->get('password'));
        User::create($request->all());
        return redirect()->route('admin.user.index');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if($request->has('password')){
            $request['password'] = bcrypt($request->get('password'));
        }
        $user->update($request->all());
        return redirect()->route('admin.user.index');

    }

    public function destroy(User $user)
    {
       $user->delete();
        return redirect()->route('admin.user.index');
    }
}
