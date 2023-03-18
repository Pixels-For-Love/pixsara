<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 * @property int $id
 * @property int $canvas_image_id
 * @property int $user_id
 * @property int pos_x
 * @property int pos_y
 * @property string color
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class CanvasImagePixel extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function canvas() : BelongsTo
    {
        return $this->belongsTo(CanvasImage::class, 'canvas_image_id', 'id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
