<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\setting;
use App\Http\Resources\SettingResource;


class SettingsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->input('setting_id') == null ? $setting_id = 0 : $setting_id = $request->input('setting_id');
        return $setting = Setting::updateOrCreate(['id' => $setting_id] ,$request->except('setting_id')) ? response()->json(["status" => true, "data" => new SettingResource($setting)]) : response()->json(["status" => false]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
