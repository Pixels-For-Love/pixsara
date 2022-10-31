<?php

namespace Tests\Unit\CanvasTests;

use App\Models\CanvasImage;
use App\Models\CanvasImagePixel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CanvasImageTest extends TestCase
{
//    use DatabaseMigrations;


    /** @test  */
    function it_responds(){
        $this->get('/api/canvas')->assertStatus(200);
    }


    /**
     * Tests the canvas list
     *
     * @test
     * @return void
     */
    public function it_gets_canvases()
    {
       CanvasImage::factory(10)->create();
        $response = $this->getJson($this->base_url . '/canvas');

        $response->assertJsonCount(10);
    }

    /**
     * Tests creating a canvas
     *
     * @test
     * @return void
     */
    public function it_creates_a_canvas()
    {
        $response = $this->postJson($this->base_url . '/canvas');
    }


}
