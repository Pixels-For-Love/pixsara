<?php

namespace App\Http\Controllers;

use App\Http\HttpStatus;
use App\Http\Requests\CreateCanvasImageRequest;
use App\Http\Requests\StoreCanvasImageRequest;
use App\Http\Requests\UpdateCanvasImageRequest;
use App\Http\Resources\CanvasImageResource;
use App\Models\CanvasImage;
use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CanvasImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        return CanvasImageResource::collection(
            QueryBuilder::for(CanvasImage::class)
                ->allowedFilters([
                    'title',
                    'description',
                    'slug',
                    'width',
                    'height',
                    'user_id',
                ])
//                ->defaultSort('-created_at')
//                ->allowedSorts('created_at', 'updated_at')
                ->paginate(20)
        );
        //
//        $canvases = QueryBuilder::for(CanvasImage::class)
//            ->allowedFilters(['title', 'description', 'slug', 'width', 'height', 'user_id'])
//            ->allowedSorts(['title', 'description', 'slug', 'width', 'height', 'user_id'])
//            ->allowedIncludes(['pixels'])
//            ->paginate(20);
//
//
//        return $this->sendResponse(CanvasImageResource::collection($canvases), 'Success');
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(CreateCanvasImageRequest $request, User $user)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request['title']);
        $canvas = auth()->user()->canvases()->create($data);

        return (new CanvasImageResource($canvas))->response()
            ->setStatusCode(HttpStatus::CREATED);
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
