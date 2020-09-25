<?php

namespace Tests\Feature;

use Faker\Factory;
use Faker\Provider\Base;
use Tests\TestCase;

class DomainControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->seed();
    }

    public function testIndex()
    {
        $response = $this->get(route('domains.index'));
        $response->assertOk();
    }

    public function testStore()
    {
        $domain = ['name' => 'https://ru.hexlet.io/professions/php/projects/9'];
        $expect  = ['name' => 'https://ru.hexlet.io'];
        $response = $this->post(route('domains.store', $domain));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('domains', $expect);
    }

    public function testShow()
    {
        $id = Base::randomDigitNot(0);
        $response = $this->get(route('domain.show', $id));
        $response->assertOk();
    }
}
