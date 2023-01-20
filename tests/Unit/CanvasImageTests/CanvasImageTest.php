<?php

namespace Tests\Unit\CanvasImageTests;

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
       $response->assertJsonCount(10, 'data');
    }


    /**
     * Tests the canvas list pagination
     *
     * @test
     * @return void
     */
    public function it_gets_canvases_pagination_limit_test()
    {
        CanvasImage::factory(50)->create();

        $response = $this->getJson($this->base_url . '/canvas?page=1');
        $json = $response->json();

        $d = collect($json['data'])->keyBy('id');

        $response = $this->getJson($this->base_url . '/canvas?page=2');
        $json = $response->json();

        $dd = collect($json['data'])->keyBy('id');

        $this->assertNotEquals($d->keys(), $dd->keys());

    }


    /**
     * Tests creating a canvas
     *
     * @test
     * @return void
     */
    public function it_creates_a_canvas()
    {

        $data = [
            'title' => 'Test Canvas',
            'description' => 'Test Canvas Description',
            'width' => 100,
            'height' => 100,
        ];

        // TODO Replace with route Name not url
        $response = $this->postJson($this->base_url . '/canvas', $data)
        ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title' => 'Test Canvas',
                    'description' => 'Test Canvas Description',
                    'width' => 100,
                    'height' => 100,
                ]
            ]);

        $canvas = CanvasImage::find($response->json('data.id'));
        print_r($canvas->toArray());
        // Check each value in the original data exsists in the database
        foreach($data as $datum => $value){
            $this->assertEquals($value, $canvas->{$datum});
        }

    }

}
