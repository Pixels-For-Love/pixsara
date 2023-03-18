<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @property string $title
 * @property int $width
 * @property int $height
 * @property string $slug
 * @property string $description
 * @property int $user_id
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 */
class CanvasImage extends Model
{
    use HasFactory;

    const DEFAULT_WIDTH = 500;
    CONST DEFAULT_HEIGHT = 500;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function pixels() : HasMany
    {
        return $this->hasMany(CanvasImagePixel::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
