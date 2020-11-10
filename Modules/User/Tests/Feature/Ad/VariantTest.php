<?php

namespace Modules\User\Tests\Feature\Ad;

use Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Modules\User\Entities\PhoneModel;
use Modules\User\Entities\PhoneVariant;
use Modules\User\Entities\User;

class VariantTest extends TestCase
{

    public function setUp(): void
    {

        parent::setUp();

        Artisan::call('module:seed');
        Sanctum::actingAs($this->user = User::factory()->create());
    }

    public function test_can_store_variant()
    {

        $this->user->ads()->insert([
            'phone_model_id' => $model = PhoneModel::first(),
        ]);

        $variant = $model->variants;

        $response = $this->post(route('user.ad.step_store_variant'), [
            'variant_id' => $variant->id,
        ]);

        $this->assertNotNull($this->user->ads()->uncompleted()->first()->phone_model_variant);

        $response->assertSessionHasNoErrors();
    }
}
