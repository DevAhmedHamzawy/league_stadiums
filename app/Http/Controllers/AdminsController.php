<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Http\Resources\AdminResource;
use Image;
use File;
use App\Role;

class AdminsController extends Controller
{
  public function store(Request $request)
  {

      // Still In Rest Mode

      /*$admin = Admin::create($request->except('role'));
      //$qrcode = QrCode::size(500)->format('png')->generate('localhost/league_stadiums', asset('images/users/qrcodes/'.$request->get('user_name').'.png'));
      $role = Role::findOrFail($request->get('role'));
      $admin->attachRole($role);

      if($request->get('image'))
      {
        $image = $request->get('image');
        $name =  time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('image'))->save(public_path('images/admins/').$name);
      }

      $admin->avatar = $name;*/

      //return $admin->update() ? response()->json(["status" => true , "data" => new AdminResource($admin)]) : response()->json(["status" => false]); 


     /*if($request->get('photo')){
      $image = $request->get('photo');
      $name =  time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
      Image::make($request->get('photo'))->save(public_path('images/admins/').$name);

      $request['image'] = $name;
     }*/

     $request['avatar'] = 'default.png';

     $request->input('admin_id') == null ? $admin_id = 0 : $admin_id = $request->input('admin_id');
     $admin = Admin::updateOrCreate(['id' => $admin_id] ,$request->except('admin_id','role','image'));
     return $admin ? response()->json(["status" => true , "data" => new AdminResource($admin)]) : response()->json(["status" => false]); 
    }


    public function destroy($id)
    {
        $admin = Admin::findOrfail($id); 

        return  $admin->delete() ? response()->json(["status" => true]) : response()->json(["status" => false]);
    }

}
