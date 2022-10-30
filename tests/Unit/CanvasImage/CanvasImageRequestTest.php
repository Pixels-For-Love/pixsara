<?php

namespace Tests\Unit\CanvasImage;

use Tests\TestCase;

class CanvasImageRequestTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @test
     * @return void
     */
    public function it_gets_canvases()
    {
        $response = $this->get('/api/canvas');

        print_r($response);


    }


}
