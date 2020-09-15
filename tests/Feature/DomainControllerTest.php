<?php

namespace Tests\Feature;

use Faker\Factory;
use Faker\Provider\Base;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DomainControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    private const DOMAIN = ['name' => 'https://ru.hexlet.io/professions/php/projects/9'];
    private const EXPECT_DOMAIN = ['name' => 'https://ru.hexlet.io'];

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
        $response = $this->post(route('domains.store', self::DOMAIN));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('domains', self::EXPECT_DOMAIN);
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
            $domainName => Http::response($data, 404)
        ]);
        $id = DB::table('domains')->where('name', $domainName)->pluck('id')->all()[0];
        $response = $this->post(route('domain.check', $id));
        $statusCode = DB::table('domain_checks')->where('domain_id', $id)->pluck('status_code')->all()[0];
        $h1 = DB::table('domain_checks')->where('domain_id', $id)->pluck('h1')->all()[0];
        $keywords = DB::table('domain_checks')->where('domain_id', $id)->pluck('keywords')->all()[0];
        $description = DB::table('domain_checks')->where('domain_id', $id)->pluck('description')->all()[0];
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('domain_checks', ['domain_id' => $id]);
        $this->assertDatabaseHas('domain_checks', ['status_code' => $statusCode]);
        $this->assertDatabaseHas('domain_checks', ['h1' => $h1]);
        $this->assertDatabaseHas('domain_checks', ['keywords' => $keywords]);
        $this->assertDatabaseHas('domain_checks', ['description' => $description]);
    }
}
