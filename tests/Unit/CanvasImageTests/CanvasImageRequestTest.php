<?php

namespace Tests\Unit\CanvasImageTests;

use App\Models\CanvasImage;
use App\Models\CanvasImagePixel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Http\HttpStatus;

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
            'height' => '150',
        ];

        $response = $this->postJson('/api/canvas', $canvasData);

        $response->assertStatus(HttpStatus::CREATED)
            ->assertJsonPath('data.id', 1)
            ->assertJsonPath('data.title', $canvasData['title'])
            ->assertJsonPath('data.description', $canvasData['description'])
            ->assertJsonPath('data.width', $canvasData['width'])
            ->assertJsonPath('data.height', $canvasData['height'])
            ->assertJsonPath('data.user_id', $this->user->id)

        ;


    }




}
