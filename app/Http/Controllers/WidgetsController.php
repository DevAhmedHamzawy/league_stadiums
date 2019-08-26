<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Widger;
use App\Http\Resources\WidgetResource;

class WidgetsController extends Controller
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
        $request->input('widget_id') == null ? $widget_id = 0 : $widget_id = $request->input('widget_id');
        return $widget = Widget::updateOrCreate(['id' => $widget_id] ,$request->except('widget_id')) ? response()->json(["status" => true, "data" => new WidgetResource($widget)]) : response()->json(["status" => false]); 
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
        return $widget_deleted = Widget::whereId($id)->delete() ? response()->json(["status" => true, "deleted" => new WidgetResource($widget_deleted)]) : response()->json(["status" => false]);
    }   
}
