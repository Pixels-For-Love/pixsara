<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property int $id
 * @property int $canvas_image_id
 * @property int $user_id
 * @property int $pos_x
 * @property int $pos_y
 * @property string $color
 * @property string $charity
 * @property float $payment_amount
 * @property string $payment_source
 * @property string $title
 * @property string $paypal_transaction
 * @property int $charity_id
 *
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 *
 *
 */
class CanvasImagePixel extends Model
{
    use HasFactory;



    public $guarded=[];

    public function canvasImage()
    {
        return $this->belongsTo(CanvasImage::class);
    }

    public function canvas()
    {
        return $this->canvasImage();
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
