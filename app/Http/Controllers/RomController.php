<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rom;

class RomController extends Controller
{
    public function index($id){

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'videogame' => 'required',
            'release' => 'required',
            'file' => 'required',
            'thumbnail' => 'mimes:png,jpg|max:2048',
        ]);
        
        if ($rom = $request->file('file')) 
            $rom_path = $rom->store('public/roms');
        
        if ($thumbnail = $request->file('thumbnail')) 
            $thumbnail_path = $thumbnail->store('public/thumbs');
        
        $rom = Rom::create([
            'name' => $validation['name'],
            'videogame' => $validation['videogame'],
            'file' => $rom_path,
            'thumbnail' => $thumbnail_path,
            'user_id' => auth()->user()->id
        ]);
        
        return  response()->json([$rom]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([Rom::find($id)]);
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
        Rom::destroy($id);
        return response()->json([]);
    }
}
