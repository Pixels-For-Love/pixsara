<?php

namespace Tests\Unit\CanvasImage;

use App\Models\CanvasImage;
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




    }


}
