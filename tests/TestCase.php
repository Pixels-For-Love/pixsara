<?php

namespace Tests;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

/**
 * @property User $user
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        Model::preventLazyLoading();

        $this->afterApplicationCreated([$this, 'seedDatabaseAndBootstrapInstance']);

    }

    public function seedDatabaseAndBootstrapInstance()
    {

        $this->user = User::create([
            'id' => '1',
            'name' => 'FirstName LastName',
            'email' => 'test@test.com',
            'password' => 'password'
        ]);

        $this->actingAs($this->user);

        $this->base_url = '/api';

    }
}
