<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canvas_image_pixels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('canvas_image_id')->index()
                ->references('id')->on('canvas_images');

            $table->foreignId('user_id')->index()->constrained();
            $table->integer('pos_x');
            $table->integer('pos_y');
            $table->string('color');

            // Payment information
            $table->enum('reward', ['charity', 'tesla'])->default('charity');
            $table->decimal('payment_amount', 8, 2)->nullable()->default(null); // amount paid for the pixel
            $table->string('payment_source')->nullable()->default(null);


            $table->string('title', 50);
            $table->text('paypal_transaction')->nullable()->default(null);
            $table->foreignId('charity_id')->nullable();//->references('id')->on('charities');



            $table->timestamps();


            // $table->unique(['pos_x', 'pos_y'];

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('canvas_image_pixels');
    }
};
