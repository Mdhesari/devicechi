<?php

namespace Modules\User\Tests\Feature\Ad;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Modules\User\Entities\User;

class CreateTest extends TestCase
{

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs($this->user = User::factory()->create());
    }

    public function test_see_create_ad()
    {
        $response = $this->get(route('user.ad.create'));

        $response->assertStatus(200);
    }

    public function test_see_choose_model()
    {
        $response = $this->get(route('user.ad.create', ['phone_brand' => 'apple']));

        $response->assertStatus(200);
    }
}
