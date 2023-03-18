<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * @property int $id
 * @property int $canvas_image_id
 * @property int $user_id
 * @property int pos_x
 * @property int pos_y
 * @property string color
 *
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('canvas_image_pixels', function (Blueprint $table) {
            $table->id();

            $table->foreignId('canvas_image_id')->index()
                ->references('id')->on('canvas_images');

            $table->foreignId('user_id')->index()->constrained();
            $table->integer('pos_x');
            $table->integer('pos_y');
            $table->string('color');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canvas_image_pixels');
    }
};
