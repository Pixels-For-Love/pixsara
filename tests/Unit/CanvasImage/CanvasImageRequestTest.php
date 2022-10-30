<?php

namespace Tests\Unit\CanvasImage;

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
        $response = $this->get('/api/canvas');

        print_r($response->content());

        print_r($response);


    }


}
