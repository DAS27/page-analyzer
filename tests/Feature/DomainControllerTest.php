<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DomainControllerTest extends TestCase
{
    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
//        $this->seed();
    }

    public function testIndex()
    {
        $response = $this->get(route('domains.index'));
        $response->assertOk();
    }

    public function testStore()
    {
        $url = $this->faker->url;
        $response = $this->post(route('domains.store', $url));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $parsedUrl = parse_url($url);
        ['scheme' => $scheme, 'host' => $host] = $parsedUrl;
        $domainName = strtolower("{$scheme}://{$host}");
        $this->assertDatabaseHas('domains', ['name' => $domainName]);
    }

    public function testShow()
    {
        $id = $this->faker->randomDigitNot(0);
        $response = $this->get(route('domain.show', $id));
        $response->assertOk();

        $this->assertDataBaseHas('domains', ['id' => $id]);
    }
}
