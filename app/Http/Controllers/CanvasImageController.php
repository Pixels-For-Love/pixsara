<?php

namespace App\Http\Controllers;

use App\Classes\Canvas;
use App\Models\CanvasImage;
use App\Models\CanvasImagePixel;
use Illuminate\Http\Request;


class CanvasImageController extends Controller
{

    const ROUTE_PATH = "/canvas/{canvas:slug?/";

    const imagePath = 'canvas_images/' ;


    //
    function index()
    {

        $canvasList = CanvasImage::with(['user','pixels'])->get();

        //ddd($canvasList);
        return view('canvas.index', ['canvasList' => $canvasList] );
    }


    function image(CanvasImage $canvas)
    {


       $canvas = Canvas::load($canvas->id);


        return $canvas->dumpResponse();
    }

    public function show(CanvasImage $canvas)
    {



        $pixels = CanvasImagePixel::with('user')->where('canvas_image_id', $canvas->id)
                        ->latest()->take(10)->get();

        return view('canvas.canvas-show', ['canvas' => $canvas, 'pixels' => $pixels] );

    }

    function createImage($fileName)
    {
        //TODO: IMPLEMENT CREATE IMAGE

    }

    function addPixel(CanvasImage $canvas)
    {

    }

    function imageExists($fileName)
    {



    }

    /**
     * Build the image from information in the database
     *
     * @param CanvasImage $canvas
     * @return view
     */
    function buildImage(CanvasImage $canvas)
    {


        $pixels = $canvas->pixels()->get();

        $height=request()->query('height');
        $width = request()->query('width');


        $canvas = Canvas::loadOrCreate($canvas->id, $width?$width:500, $height?$height:500 );


        foreach($pixels as $pixel){
            $canvas->setPixel($pixel->pos_x, $pixel->pos_y, $pixel->color );
        }

        $canvas->save();


    }



}
