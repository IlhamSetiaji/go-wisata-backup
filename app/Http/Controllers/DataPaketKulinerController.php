<?php

namespace App\Http\Controllers;

use App\Models\DataPaketKuliner;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDataPaketKulinerRequest;
use App\Http\Requests\UpdateDataPaketKulinerRequest;

class DataPaketKulinerController extends Controller
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
     * @param  \App\Http\Requests\StoreDataPaketKulinerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDataPaketKulinerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataPaketKuliner  $dataPaketKuliner
     * @return \Illuminate\Http\Response
     */
    public function show(DataPaketKuliner $dataPaketKuliner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataPaketKuliner  $dataPaketKuliner
     * @return \Illuminate\Http\Response
     */
    public function edit(DataPaketKuliner $dataPaketKuliner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDataPaketKulinerRequest  $request
     * @param  \App\Models\DataPaketKuliner  $dataPaketKuliner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDataPaketKulinerRequest $request, DataPaketKuliner $dataPaketKuliner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataPaketKuliner  $dataPaketKuliner
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataPaketKuliner $dataPaketKuliner)
    {
        //
    }
}