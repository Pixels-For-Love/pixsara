<?php

namespace App\Models;

use App\Http\Resources\CanvasImageResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 *
 * @property int $width
 * @property int $height
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 *
 */
class CanvasImage extends Model
{
    use HasFactory;

    public $http_resource = CanvasImageResource::class;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pixels()
    {
        return $this->hasMany(CanvasImagePixel::class);
    }


}
