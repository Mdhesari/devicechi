<?php

namespace Modules\User\Tests\Feature\Ad\Steps;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Sanctum;
use Modules\User\Entities\PhoneModel;
use Modules\User\Entities\User;

class PriceTest extends TestCase
{

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('module:seed');
        Sanctum::actingAs($this->user = User::factory()->create());
    }

    public function test_can_store_price()
    {

        $price = 134567890; // 10 total digits

        $ad = $this->user->ads()->create([
            'phone_model_id' => PhoneModel::first()->id,
        ]);

        $this->assertIsObject($ad);

        $response = $this->post(route('user.ad.step_phone_price'), [
            'price' => $price,
        ]);

        $ad->refresh();

        $response->assertRedirect(route('user.ad.create'));

        $this->assertEquals($price, $ad->price);
    }


    public function test_can_store_decimal_price()
    {

        $price = 134567890.12; // 12 total digits

        $ad = $this->user->ads()->create([
            'phone_model_id' => PhoneModel::first()->id,
        ]);

        $this->assertIsObject($ad);

        $response = $this->post(route('user.ad.step_phone_price'), [
            'price' => $price,
        ]);

        $ad->refresh();

        $response->assertRedirect(route('user.ad.create'));

        $this->assertEquals($price, $ad->price);
    }

    public function test_unable_to_store_invalid_max_price()
    {

        $price = 12345678901.12; // 13 total digits which is bigger than 12 and invalid

        $ad = $this->user->ads()->create([
            'phone_model_id' => PhoneModel::first()->id,
        ]);

        $this->assertIsObject($ad);

        $response = $this->post(route('user.ad.step_phone_price'), [
            'price' => $price,
        ]);

        $ad->refresh();

        $response->assertSessionHasErrors();
    }

    public function test_invalid_store_price()
    {

        $price = 'invalid_data_type';

        $ad = $this->user->ads()->create([
            'model_id' => PhoneModel::first()->id,
        ]);

        $response = $this->post(route('user.ad.step_phone_price'), [
            'price' => $price,
        ]);

        $ad->refresh();

        $response->assertSessionHasErrors();
    }
}
