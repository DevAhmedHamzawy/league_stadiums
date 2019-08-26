<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsTeller;
use App\Http\Resources\NewsTellerResource;


class NewsTellersController extends Controller
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
        $request->input('news_teller_id') == null ? $news_teller_id = 0 : $news_teller_id = $request->input('news_teller_id');
        return $news_teller = NewsTeller::updateOrCreate(['id' => $news_teller_id] ,$request->except('news_teller_id')) ? response()->json(["status" => true, "data" => new NewsTellerResource($news_teller)]) : response()->json(["status" => false]); 
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
        return $news_teller_deleted = NewsTeller::whereId($id)->delete() ? response()->json(["status" => true, "deleted" => new NewsTellerResource($news_teller_deleted)]) : response()->json(["status" => false]);
    }
}
