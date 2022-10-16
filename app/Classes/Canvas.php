<?php

namespace App\Classes;

use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;


class Canvas{

    /**
     * location of the image
     *
     * @var string
     */
    public $imageFile;

    /**
     * image
     *
     * @var ImageManager;
     */
    public $image;


    const IMAGE_PATH = 'canvas_images/';

    const DEFAULT_WIDTH  = 1500;
    const DEFAULT_HEIGHT = 1500;

    /**
     * Create new instance of the image handler
     *
     * @param string $canvasName
     */
    public function __construct($canvasName = "")
    {
        if($canvasName){

            $file = self::file($canvasName);
            // ddd($canvasName);

            $this->image = ImageManagerStatic::make($file);
        }

        return $this;
    }

    /**
     * create a new instance of Canvas and returns an instance
     * of this object
     *
     * @param string $canvasName
     * @param int $width
     * @param int $height
     * @param string $color
     * @param string $type
     * @return Canvas
     *
     */
    static function create($canvasName, $width = null, $height = null, $color = null, $type = "png")
    {

        // configure with favored image driver (gd by default)
        // Image::configure(array('driver' => 'imagick'));

        $width  = $width  ? $width  : self::DEFAULT_WIDTH;
        $height = $height ? $height : self::DEFAULT_HEIGHT;

        $file = self::file($canvasName);
        $image = ImageManagerStatic::canvas($width, $height, $color)->save($file);

        //$image->pixel("#ffffff",10,10);

        $self = new self(null);
        $self->imageFile = $canvasName;
        $self->image = $image;

        return $self;

    }

    /**
     * Sets the pixel at x,y position with provided color
     *
     * @param int $x
     * @param int $y
     * @param string $color
     * @return Canvas
     */
    public function setPixel($x, $y, $color)
    {


        $this->image->pixel($color, $x, $y);

        return $this;
    }

    /**
     * save
     *
     * @param string $canvasName optional
     * @return Canvas
     */
    public function save($canvasName = null)
    {
        if($canvasName){
            $file = self::file($canvasName);
            $this->image->save($file);
        }else{
            $this->image->save();
        }


        return $this;
    }

    /**
     * Dump response to browser
     *
     * @return response
     */
    public function dumpResponse()
    {
        return $this->image->response();
    }

    /**
     * Return path and file name for given name
     *
     * @param string $canvasName
     * @return string
     */
    static function file($canvasName)
    {

        if(! Str::endsWith($canvasName, '.png')){
            return storage_path(self::IMAGE_PATH . $canvasName . '.png');
        }

        return $canvasName;
    }


    /**
     * load image file
     *
     * @param string $canvasName
     * @return Canvas
     */
    static function load($canvasName)
    {
        $file = self::file($canvasName);


        return new self($file);
    }

    /**
     * load or create an image
     *
     * @param string $canvasName
     * @param integer $width
     * @param integer $height
     *
     * @return Canvas
     */
    static function loadOrCreate($canvasName, $width=null, $height=null)
    {
        $file = self::file($canvasName);

        if(file_exists($file)){
            return self::load($file);
        }

        return self::create($file, $width, $height);
    }

    /**
     * get a random color in #ffffff format
     *
     * @return string
     */
    static function getRandomColor(){

        return "#" . sprintf("%02X%02X%02X", mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
    }




}
