<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use App\Models\Pagination;

class UserController extends Controller
{
    public function index()
    {
       /*$users = User::orderBy('id', 'desc')->paginate(5);*/
        
        

        $users = DB::table('users')
                ->leftjoin('customermaster','users.merchant_id','=','customermaster.CustomerCode')
                ->leftjoin('categorymaster','customermaster.CustomerCategory','=','categorymaster.CategoryId')
                ->select('users.*','categorymaster.CategoryName')
                ->simplePaginate(100);
                
        
        
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
    
    public function loyalityPoints(){
        
       $item_code = DB::table('sku_pointscalculations')
                   ->join('invoicedetail','sku_pointscalculations.item_code','=','invoicedetail.ItemCode')
                   ->select('invoicedetail.InvNumber','invoicedetail.Total_sales')
                   ->take(3)
                   ->get();
                  dd($item_code);
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
