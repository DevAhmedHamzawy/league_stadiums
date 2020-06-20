<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use App\Http\Resources\SettingResource;


class SettingsController extends Controller
{
   
    public function store(Request $request)
    {
        $settings_id = 1;
        $setting = Setting::updateOrCreate(['id' => $settings_id] ,$request->except('settings_id'));
        return $setting ? response()->json(["status" => true, "data" => new SettingResource($setting)]) : response()->json(["status" => false]);  
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $setting_deleted = Setting::whereId($id)->delete() ? response()->json(["status" => true, "deleted" => new SettingResource($setting_deleted)]) : response()->json(["status" => false]);
    }
}
