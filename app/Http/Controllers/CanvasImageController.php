<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCanvasImageRequest;
use App\Http\Requests\UpdateCanvasImageRequest;
use App\Http\Resources\CanvasImageResource;
use App\Models\CanvasImage;
use Spatie\QueryBuilder\QueryBuilder;

class CanvasImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        $canvases = CanvasImage::all();
        return response()->json($canvases);
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
     * @param  \App\Http\Requests\StoreCanvasImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCanvasImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CanvasImage  $canvasImage
     * @return \Illuminate\Http\Response
     */
    public function show(CanvasImage $canvasImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CanvasImage  $canvasImage
     * @return \Illuminate\Http\Response
     */
    public function edit(CanvasImage $canvasImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCanvasImageRequest  $request
     * @param  \App\Models\CanvasImage  $canvasImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCanvasImageRequest $request, CanvasImage $canvasImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CanvasImage  $canvasImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CanvasImage $canvasImage)
    {
        //
    }
}
