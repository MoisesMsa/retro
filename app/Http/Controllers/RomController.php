<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rom;

class RomController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'videogame' => 'required',
            'file' => 'required'
            'thumbnail' => 'mimes:png,jpg|max:2048',
        ]);
        
        $rom = Rom::create($request->all());

        return $rom;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Rom::find($id);
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
        $rom = Rom::find($id);
        $rom->update($request->all());
        
        return $rom;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Rom::destroy($id);
    }
}
