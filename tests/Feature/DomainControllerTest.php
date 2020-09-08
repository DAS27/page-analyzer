<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DomainControllerTest extends TestCase
{
    private const DOMAIN = ['name' => 'https://ru.hexlet.io/professions/php/projects/9'];
    private const EXPECT_DOMAIN = ['name' => 'https://ru.hexlet.io'];

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
        $domain = self::EXPECT_DOMAIN;
        $id = DB::table('domains')->where('name', $domain['name'])->pluck('id')->all()[0];
        $response = $this->get(route('domain.show', ['id' => $id]));
        $response->assertOk();
    }

    public function testCheck()
    {
        $domain = self::EXPECT_DOMAIN;
        $id = DB::table('domains')->where('name', $domain['name'])->pluck('id')->all()[0];
        $response = $this->post(route('domain.check', $id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('domain_checks', ['domain_id' => $id]);
    }
}
