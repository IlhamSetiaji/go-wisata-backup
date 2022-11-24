<?php

namespace App\Http\Controllers;

use App\Models\tb_datakuliner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Storetb_datakulinerRequest;
use App\Http\Requests\Updatetb_datakulinerRequest;

class TbDatakulinerController extends Controller
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
     * @param  \App\Http\Requests\Storetb_datakulinerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetb_datakulinerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tb_datakuliner  $tb_datakuliner
     * @return \Illuminate\Http\Response
     */
    public function show(tb_datakuliner $tb_datakuliner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tb_datakuliner  $tb_datakuliner
     * @return \Illuminate\Http\Response
     */
    public function edit(tb_datakuliner $tb_datakuliner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetb_datakulinerRequest  $request
     * @param  \App\Models\tb_datakuliner  $tb_datakuliner
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetb_datakulinerRequest $request, tb_datakuliner $tb_datakuliner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tb_datakuliner  $tb_datakuliner
     * @return \Illuminate\Http\Response
     */
    public function destroy(tb_datakuliner $tb_datakuliner)
    {
        //
    }
}
