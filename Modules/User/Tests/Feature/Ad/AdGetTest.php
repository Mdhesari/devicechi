<?php

namespace Modules\User\Tests\Feature\Ad;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\Ad;
use Modules\User\Entities\User;

class AdGetTest extends TestCase
{

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('module:seed');
        Sanctum::actingAs($this->user = User::factory()->create());
    }

    public function test_if_can_get_all()
    {

        Ad::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->get(route('user.ad.get'));

        $response->assertJsonStructure(['ads']);

        $data = $response->json();

        $this->assertIsArray($data['ads']);

        $this->assertCount(1, $data['ads']);

        $response->assertSuccessful();
    }

    public function test_should_get_no_ads_if_its_not_for_current_user()
    {

        $newUser = User::factory()->create();

        Ad::factory()->create([
            'user_id' => $newUser->id,
        ]);

        $response = $this->get(route('user.ad.get'));

        $response->assertJsonStructure(['ads']);

        $data = $response->json();

        $this->assertIsArray($data['ads']);

        $this->assertCount(0, $data['ads']);

        $response->assertSuccessful();
    }

    public function test_if_can_uncompleted_ads()
    {
        Ad::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->get(route('user.ad.get.status', [
            'status' => Ad::STATUS_UNCOMPLETED,
        ]));

        $response->assertJsonStructure(['ads']);

        $data = $response->json();

        $this->assertCount(1, $data['ads']);

        $response->assertSuccessful();
    }

    public function test_if_can_pending_ads()
    {
        Ad::factory()->create([
            'user_id' => $this->user->id,
            'status' => Ad::STATUS_PENDING,
        ]);

        $response = $this->get(route('user.ad.get.status', [
            'status' => Ad::STATUS_PENDING,
        ]));

        $response->assertJsonStructure(['ads']);

        $data = $response->json();

        $this->assertCount(1, $data['ads']);

        $response->assertSuccessful();
    }

    public function test_if_can_unavailable_ads()
    {
        Ad::factory()->create([
            'user_id' => $this->user->id,
            'status' => Ad::STATUS_UNAVAILABLE,
        ]);

        $response = $this->get(route('user.ad.get.status', [
            'status' => Ad::STATUS_UNAVAILABLE,
        ]));

        $response->assertJsonStructure(['ads']);

        $data = $response->json();

        $this->assertCount(1, $data['ads']);

        $response->assertSuccessful();
    }

    public function test_if_can_rejected_ads()
    {
        Ad::factory()->create([
            'user_id' => $this->user->id,
            'status' => Ad::STATUS_REJECTED,
        ]);

        $response = $this->get(route('user.ad.get.status', [
            'status' => Ad::STATUS_REJECTED,
        ]));

        $response->assertJsonStructure(['ads']);

        $data = $response->json();

        $this->assertCount(1, $data['ads']);

        $response->assertSuccessful();
    }

    public function test_if_can_available_ads()
    {
        Ad::factory()->create([
            'user_id' => $this->user->id,
            'status' => Ad::STATUS_AVAILABLE,
        ]);

        $response = $this->get(route('user.ad.get.status', [
            'status' => Ad::STATUS_AVAILABLE,
        ]));

        $response->assertJsonStructure(['ads']);

        $data = $response->json();

        $this->assertCount(1, $data['ads']);

        $response->assertSuccessful();
    }
}
