<?php

namespace App\Http\Controllers;

use App\Models\SaveFile;
use App\Http\Requests\StoreSaveFileRequest;
use App\Http\Requests\UpdateSaveFileRequest;

class SaveFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("savefile/saveFile");
    }

    public function add()
    {
        return view("savefile/addSaveFile");
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
     * @param  \App\Http\Requests\StoreSaveFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaveFileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaveFile  $saveFile
     * @return \Illuminate\Http\Response
     */
    public function show(SaveFile $saveFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaveFile  $saveFile
     * @return \Illuminate\Http\Response
     */
    public function edit(SaveFile $saveFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaveFileRequest  $request
     * @param  \App\Models\SaveFile  $saveFile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaveFileRequest $request, SaveFile $saveFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaveFile  $saveFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaveFile $saveFile)
    {
        //
    }
}
