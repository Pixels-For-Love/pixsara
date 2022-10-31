<?php

namespace Tests\Unit\CanvasTests;

use App\Models\CanvasImage;
use App\Models\CanvasImagePixel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CanvasImageRequestTest extends TestCase
{
//    use DatabaseMigrations;


    /** @test  */
    function it_responds(){
        $this->get('/api/canvas')->assertStatus(200);
    }


    /**
     * A basic unit test example.
     *
     * @test
     * @return void
     */
    public function it_gets_canvases()
    {
       CanvasImage::factory(10)->create();
        $response = $this->getJson('/api/canvas');
        $response->assertJsonCount(10);
    }


    /**
     * A basic unit test example.
     *
     * @test
     * @return void
     */
    public function it_creates_canvases()
    {
        //$canvasData = CanvasImage::factory()->make()->toArray();

        $canvasData = [
            'title' => 'Canvas Title',
            'description' => 'Canvas Description',
            'width' => '100',
            'height' => '100',
        ];

        $response = $this->postJson('/api/canvas', $canvasData);
        $response->assertStatus(201);
    }




}
