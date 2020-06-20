<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Widget;
use Image;
use File;
use App\Http\Resources\WidgetResource;

class WidgetsController extends Controller
{
    public function getWidgets(){
        $widgets = Widget::paginate(10);
        return response()->json(["status" => true, "data" =>  WidgetResource::Collection($widgets)]);
    }
    
    public function store(Request $request)
    {

        if($request->get('photo'))
        {
            if($request->input('widget_id') != null){

               $widget = Widget::findOrfail($request->input('widget_id')); 

               $imagePath = public_path('images/widgets/').$widget->image; 

               if(File::exists($imagePath)){
                    File::delete($imagePath);
               }

            }

            $image = $request->get('photo');
            $name =  time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('photo'))->save(public_path('images/widgets/').$name);
        }

        $request->input('widget_id') == null ? $widget_id = 0 : $widget_id = $request->input('widget_id');
        $request['image'] = $name;

        $widget = Widget::updateOrCreate(['id' => $widget_id] ,$request->except('widget_id','widget_add','photo'));
        return $widget ? response()->json(["status" => true, "data" => new WidgetResource($widget)]) : response()->json(["status" => false]); 
 
    }

    public function destroy($id)
    {
        return $widget_deleted = Widget::whereId($id)->delete() ? response()->json(["status" => true, "deleted" => new WidgetResource($widget_deleted)]) : response()->json(["status" => false]);
    }   
}
