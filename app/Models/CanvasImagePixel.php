<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanvasImagePixel extends Model
{
    use HasFactory;



    public $guarded=[];

    public function canvasImage()
    {
        return $this->belongsTo(CanvasImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function imprint(){



        $this->canvasImage()->saveImagePixel($this->pos_x, $this->pos_y, $this->color);

    }

    /**
     * Stores temporary data in a session or cookie
     *
     *
     * @param String $key
     * @param mixed $value
     * @return void
     */
    public static function cache(String $key, $value = null)
    {

        if($value === null){
            // set the value

            if(session()->has($key)){
                return session($key);
            }

            return null;
        }

        //cookie()->queue(KEY_NEW_PIXEL . '.' . $key, $value, COOKIE__ONE_MONTH * 2);
        session([$key => $value]);

    }




}
