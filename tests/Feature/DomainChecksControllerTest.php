<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DomainChecksController extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->seed();
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
