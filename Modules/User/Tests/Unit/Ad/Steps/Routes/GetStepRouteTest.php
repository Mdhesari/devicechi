<?php

namespace Modules\User\Tests\Unit\Ad\Steps\Routes;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Modules\User\Entities\User;
use Modules\User\Http\Controllers\Ad\BaseAdController;

class GetStepRouteTest extends TestCase
{

   protected $user;

   public function setUp(): void
   {
      parent::setUp();

      $this->user = User::factory()->create();
      Sanctum::actingAs($this->user);
   }

   public function test_can_get_brand_step_route()
   {

      $response = $this->get(route('user.ad.routes', [
         'step' => BaseAdController::STEP_CHOOSE_BRAND,
      ]));

      $response->assertJson([
         'status' => true,
         'data' => [
            'current' => route('user.ad.create'),
            'back' => null,
            'step' => BaseAdController::STEP_CHOOSE_BRAND,
         ],
      ]);
   }
}
