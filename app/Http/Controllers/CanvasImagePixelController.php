<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCanvasImagePixelRequest;
use App\Http\Requests\UpdateCanvasImagePixelRequest;
use App\Models\CanvasImagePixel;

class CanvasImagePixelController extends Controller
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
     * @param  \App\Http\Requests\StoreCanvasImagePixelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCanvasImagePixelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CanvasImagePixel  $canvasImagePixel
     * @return \Illuminate\Http\Response
     */
    public function show(CanvasImagePixel $canvasImagePixel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CanvasImagePixel  $canvasImagePixel
     * @return \Illuminate\Http\Response
     */
    public function edit(CanvasImagePixel $canvasImagePixel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCanvasImagePixelRequest  $request
     * @param  \App\Models\CanvasImagePixel  $canvasImagePixel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCanvasImagePixelRequest $request, CanvasImagePixel $canvasImagePixel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CanvasImagePixel  $canvasImagePixel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CanvasImagePixel $canvasImagePixel)
    {
        //
    }
}
