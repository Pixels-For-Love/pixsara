<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCanvasImageRequest;
use App\Http\Requests\UpdateCanvasImageRequest;
use App\Models\CanvasImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CanvasImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCanvasImageRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CanvasImage $canvasImage): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CanvasImage $canvasImage): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCanvasImageRequest $request, CanvasImage $canvasImage): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CanvasImage $canvasImage): RedirectResponse
    {
        //
    }
}
