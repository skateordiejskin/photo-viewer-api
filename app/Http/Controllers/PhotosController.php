<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 15);
        $width = $request->input('width');
        $height = $request->input('height');

        $photos = Photo::when($width, function ($query, $width) {
            $query->where('dimensions->width', $width);
        })->when($height, function ($query, $height) {
            $query->where('dimensions->height', $height);
        })->paginate($limit);
        // $ids = $photos->pluck('id')->all();
        // dd($ids);
        return response()->json($photos);
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
        //
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
        //
    }

    public function image(Request $request, $name)
    {

        $color = $request->has('grayscale') ? 'grayscale' : 'original';
        $external_id = explode('_', \Arr::last(explode('id_', $name)))[0];

        return \Redis::hget("images:{$external_id}", $color);
    }
}
