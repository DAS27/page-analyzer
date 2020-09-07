<?php

namespace Tests\Feature;

use Faker\Factory;
use Faker\Provider\Base;
use Tests\TestCase;
use Faker\Generator;

class DomainControllerTest extends TestCase
{
    protected Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }

    public function testIndex()
    {
        $response = $this->get(route('domains.index'));
        $response->assertOk();
    }

    public function testStore()
    {
        $url = $this->faker->url;
        $response = $this->post(route('domains.store', ['name' => $url]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $parsedUrl = parse_url($url);
        ['scheme' => $scheme, 'host' => $host] = $parsedUrl;
        $domainName = strtolower("{$scheme}://{$host}");
        $this->assertDatabaseHas('domains', ['name' => $domainName]);
    }

    public function testShow()
    {
        $id = Base::randomDigitNot(0);
        $response = $this->get(route('domain.show', $id));
        $response->assertOk();

        $this->assertDataBaseHas('domains', ['id' => $id]);
    }
}
