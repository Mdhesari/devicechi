<?php

namespace Modules\User\Tests\Feature\Ad;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\PhoneBrand;
use Modules\User\Entities\User;

class CreateTest extends TestCase
{

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('module:seed');
        Sanctum::actingAs($this->user = User::factory()->create());
    }

    public function test_see_create_ad()
    {
        $response = $this->get(route('user.ad.create'));

        $response->assertStatus(200);
    }

    public function test_see_choose_model()
    {
        $response = $this->get(route('user.ad.step_phone_model', ['phone_brand' => 'apple']));

        $response->assertStatus(200);
    }

    public function test_see_choose_variant()
    {

        $phone_brand = PhoneBrand::first();

        $phone_model_name = $phone_brand->models()->first()->name;

        $response = $this->get(route('user.ad.step_phone_model_variant', ['phone_brand' => $phone_brand->name, 'phone_model' => $phone_model_name]));

        $response->assertStatus(200);
    }

    public function test_cant_see_choose_variant_if_already_have_done_this_step()
    {

        $phone_brand = PhoneBrand::first();

        $phone_model = $phone_brand->models()->first();

        $this->user->ads()->create([
            'phone_model_id' => $phone_model->id,
            'phone_model_variant_id' => $phone_model->variants()->first()->id,
        ]);

        $url = route('user.ad.step_phone_model_variant', ['phone_brand' => $phone_brand->name, 'phone_model' => $phone_model->name]);

        $response = $this->get($url);

        $response->assertRedirect();
    }
}
