<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Classes\Canvas;


class CanvasImage extends Model
{
    use HasFactory;


    /**
     * Canvas Width - Int
     *
     * @var $width
     */

     /**
     * Canvas Height - Int
     * @var $height
     */

    public $canvas;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pixels()
    {
        return $this->hasMany(CanvasImagePixel::class);
    }


    /**
     * Returns the next available position
     *
     * @return ['x'=>int, 'y'=>int ]
     */
    public function getNextPixel()
    {
        $position = ['x'=>1, 'y'=>1];

        $query = 'SELECT canvas_image_id, max(pos_y) as max_y, max(pos_x) as max_x
                    FROM `canvas_image_pixels`
                    where canvas_image_id = :id group by canvas_image_id, pos_y
                    order by pos_y desc
                    ;';

        $result = DB::select( DB::raw($query), ['id' =>   $this->id ] );

        if(isset($result[0])){

            $r = $result[0];
            print_r($r);

            // MAX_X
            if($result[0]->max_y == $this->height
                && $result[0]->max_x == $this->width ){

                    ddd(["ERROR" => "IMAGE IS FULL",
                    'X' => $result[0]->max_x,
                    'Y'=>$result[0]->max_y ]);

            }

            foreach($result as $row){

                $mx = $row->max_x;

                if($mx < $this->width){
                    $position['y'] = $row->max_y;
                    $position['x'] = $mx + 1;

                    return $position;
                }elseif($mx == $this->width){
                    $position['y'] = $row->max_y+1;
                    $position['x'] = 1;

                    return $position;
                }

            }


        }else{
            return ['x'=>1, 'y'=>1];
        }

        ddd($result);

        return $position;
    }

    /**
     * Save a color to a specific position
     *
     * @param int $x
     * @param int $y
     * @param string $color
     * @return void
     */
    public function saveImagePixel($x,$y,$color){

        $canvas = Canvas::load($this->id);

        $canvas->setPixel($x, $y, $color);
        $canvas->save();

    }



}



