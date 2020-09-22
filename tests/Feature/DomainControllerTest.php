<?php

namespace Tests\Feature;

use Faker\Factory;
use Faker\Provider\Base;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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

    public function testCheck()
    {
        $domainName = DB::table('domains')->inRandomOrder()->first('name')->name;
        $data = file_get_contents(__DIR__ . '/../fixtures/test.html');
        Http::fake([
            $domainName => Http::response($data, 200)
        ]);
        $id = DB::table('domains')->where('name', $domainName)->pluck('id')->first();
        $response = $this->post(route('domain.check', $id));
        $expect = ['h1' => 'This is H1', 'description' => 'This is Description'];
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('domain_checks', $expect);
    }
}
