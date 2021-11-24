<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPush;
use App\Models\Notification;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Http\Controllers\Api\UserController as Push;

class CustomPushController extends Controller
{
    public function index()
    {
        //$customPush = CustomPush::all();
         $notifications = Notification::with('user')->orderBy('id', 'DESC')->paginate(10);
               
        return view('admin.custom_push.custom_push', compact('notifications'));
    }

    public function store(Request $request)
    {
       
         
        $request['status'] = 1;
         $image = $request->file("icon");
       /* if ($image) {

            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/media/';
            $image_url = $upload_path.$image_full_name;
            $path = $image->move($upload_path,$image_full_name);
        }*/
        $path = "";
        if($image)
        {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'public/images/';
            $image_url = $upload_path.$image_full_name;
           
            $path = $image->move($upload_path,$image_full_name);
            
        }
     
        $user_tokens = [];
       
         foreach($request->user_id as $user_id) 
         {
            
             $user = User::find($user_id);
             
             if(empty($user) || !$user->notification_enabled)
                continue;
                
            $user_tokens[] = $user->device_token;
                
            $notifications = new Notification;
         
            $notifications->user_id = $user->id; 
            $notifications->title = $request->title;
            $notifications->icon = $path;
            $notifications->detail = $request->detail;
      
            $notifications->save();
          
        }
    
       if(!empty($user_tokens))
        {
         (new Push)->sendPushNotification($user_tokens,$notifications->title, $notifications->detail, $notifications->icon);
        }
        
        return back();
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);

              
        $notification->delete();
        return back();
    }
    
    public function fetchUser(Request $request){
        
        
    }

}