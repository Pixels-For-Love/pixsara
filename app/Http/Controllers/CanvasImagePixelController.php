<?php

namespace App\Http\Controllers;

use App\Models\CanvasImagePixel;
use Illuminate\Http\Request;
use App\Models\CanvasImage;
use App\Rules\IsColorRule;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use PayPal\Api\Amount;

class CanvasImagePixelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CanvasImage $canvas, CanvasImagePixel $pixel)
    {


        //
        return view('canvas.pixel', [ 'pixel' => $pixel, 'bgcolor' => $pixel->color ]  );

    }

    /**
     * Display the checkout form
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(CanvasImage $canvas)
    {
        $viewData = [];
        $viewData['newPixel'] = session(KEY_NEW_PIXEL);
        $viewData['donationAmount'] = request('custom_donation', DONATION_MINIMUM );
        $viewData['canvas'] = $canvas;



        //
        return view('canvas.checkout', $viewData  );

    }


    /**
     * Paypal Javascript Handler
     *
     * @return \Illuminate\Http\Response
     */
    public function paypal_success(CanvasImage $canvas)
    {
        $viewData = [];


        $viewData['canvas'] = $canvas;
        $viewData['color'] = request('color');
        $viewData['reward'] = request('reward');

        // ignore charity selection if charity was not selected
        if($viewData['reward']=='charity'){
            $viewData['charityId'] = request('charityId');
        }else {
            $viewData['charityId'] = null;
        }

        $viewData['amount'] = request('amount');
        $viewData['paypalPayload'] = request('paypal_payload');

        $viewData['all'] = request()->all();

        $position = $canvas->getNextPixel();
//        ddd("WTF");

        $newPixel = CanvasImagePixel::create([
            'canvas_image_id' => $canvas->id,
            'user_id' => request()->user()->id,
            'pos_x' => $position['x'],
            'pos_y' => $position['y'],
            'color' => $viewData['color'],
            'reward' => $viewData['reward'],
            'charity_id' => $viewData['charityId'],
            'payment_amount' => $viewData['amount'],
            'paypal_transaction' => $viewData['paypalPayload'],
            'payment_source' => 'paypal-js-sdk',
            'title' => "Y:" . $position['y'] . ' -- X:' . $position['x']
        ]);

        $viewData['newPixel'] = $newPixel;


        // modify the image
        $canvas->saveImagePixel( $position['x'], $position['y'], $viewData['color'] );


        print_r($newPixel->id);

        $url = "/canvas/" . $canvas->slug . '/' . $newPixel->id;
        return redirect( $url );

    }


    public function view_pixel(CanvasImage $canvas, CanvasImagePixel $canvasImagePixel){

        $viewData = ['canvas' => $canvas, 'pixel' => $canvasImagePixel];

        return view('canvas.pixel-display', $viewData);
    }



    /**
     * Returns string if there is an error with the fragment
     * Returns false if there is no error
     *
     * @param array $d -- [color-hexcolor, charityId-int, reward-enum(charity|prize) ]
     *
     * @return String
     */
    public function invalidPixel($d)
    {



        $redirectUrl = '';
        //$d = array(); // data being passed to the view

        //$d['color'] =  request('hiddenColor');
        //$d['charityId'] = $charityId = request('charity');
        //$d['reward'] = strtolower(request('reward'));

        $validColor = isset($d['color']) && isColor($d['color']);
        $validReward = isset($d['reward']) && ($d['reward']=='charity' || $d['reward']=='tesla' );
        // $validCharity = $d['reward']=='tesla' ? true :   $d['charityId']>0;
        $charityId = isset($d['charityId']) ? $d['charityId'] : null;

        // assign important objects to the view
        //$d['canvas']= $canvas;
        // $d['pixel'] =  $pixel;

        // If they did not provide a color, return
        if( ! $validColor ){

            //ddd($d);
            return
                '?err=Invalid+Color#color' ;
        }

        // Invalid Reward // Return and have them reselect, provide color
        if( ! $validReward){

            return
                '?color=' . urlencode($d['color']) .
                '?err=Invalid+Reward+Selected#reward' ;
        }


        // If the reward is a charity then require a charity
        //
        if($d['reward'] == 'charity'){

            $charity = \App\Models\Charity::find($charityId);

            if(! $charity){

                return '?color=' . urlencode($d['color']) .
                        '&reward=charity&err=Invalid+Charity#charities' ;
            }
        }


        return false;
    }


    /**
     * Validate the incoming pixel form
     *
     * @return \Illuminate\Http\Response
     */
    public function validatePixel(CanvasImage $canvas)
    {

        $redirectUrl = '';
        $d = array(); // data being passed to the view

        $d['color'] =  request('hiddenColor');
        $d['charityId'] = $charityId = request('charity');
        $d['reward'] = strtolower(request('reward'));

        if($error = $this->invalidPixel($d)){
            return redirect( route('canvas.pixel.create', $canvas) . $error );
        }

        // save the data
        // $payload = json_encode($d);

        // save pixel to the session for later use
        session([KEY_NEW_PIXEL => $d]);
        //CanvasImagePixel::cache('color', $d['color']);
        //CanvasImagePixel::cache('charityId', $d['charityId']);
        //CanvasImagePixel::cache('reward', $d['reward']);


        // SET COOKIE FOR 60 DAYS
        // cookie()->queue(KEY_NEW_PIXEL, $payload, COOKIE__ONE_MONTH * 2);
        //Cookie::queue(KEY_NEW_PIXEL, $payload, COOKIE__ONE_MONTH * 2);


        return redirect( route('canvas.pixel.create.select-donate', $canvas ) . '' );

    }


    /**
     * Display the pricing form
     *
     * @return \Illuminate\Http\Response
     */
    public function donate(CanvasImage $canvas)
    {

        $viewData = array();

        // assign important objects to the view
        $viewData['canvas']= $canvas;


        //$new_pixel = json_decode(Cookie::get(KEY_NEW_PIXEL));
        $newPixel = session(KEY_NEW_PIXEL);

        if( $validationFragment = $this->invalidPixel($newPixel) ){
            return redirect( route('canvas.pixel.create', $canvas ) . $validationFragment);
        }

        $viewData['newPixel'] = $newPixel;

        // allow for the work tesla or prize for forward compatibility
        $viewData['showEntriesClass'] =  in_array($newPixel['reward'],['tesla','prize']) ? 'visible' : 'hidden';
        $viewData['isCharity'] =  in_array($newPixel['reward'],['tesla','prize']) ? false : true;

        return view('canvas.select-donation', $viewData );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CanvasImage $canvas )
    {



        //
        return view('canvas.pixel-create', ['canvas' => $canvas]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function info(CanvasImage $canvas, Request $request)
    {



        //
        return view('canvas.pixel-create', ['canvas' => $canvas]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CanvasImage $canvas, Request $request)
    {
        //
        $validated = $request->validate([
            'hiddenColor' => [ 'required' , new \App\Rules\IsColorRule() ]
        ]);

        ddd($request);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CanvasImagePixel  $canvasImagePixel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CanvasImagePixel $canvasImagePixel)
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
