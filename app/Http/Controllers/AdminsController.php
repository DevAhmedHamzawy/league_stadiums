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
    if($request->get('photo'))
    {
        if($request->input('admin_id') != null){

           $admin = Admin::findOrfail($request->input('admin_id')); 

           $imagePath = public_path('images/admins/').$admin->image; 

           if(File::exists($imagePath)){
                File::delete($imagePath);
           }

        }

        $image = $request->get('photo');
        $name =  time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        Image::make($request->get('photo'))->save(public_path('images/admins/').$name);
    }

    $request->input('admin_id') == null ? $admin_id = 0 : $admin_id = $request->input('admin_id');
    $request['image'] = $name;
    $admin = Admin::updateOrCreate(['id' => $admin_id] ,$request->except('admin_id','photo','role'));
    return $admin ? response()->json(["status" => true, "data" => new AdminResource($admin)]) : response()->json(["status" => false]); 

  }
}
