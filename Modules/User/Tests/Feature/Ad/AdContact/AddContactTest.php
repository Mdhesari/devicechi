<?php

namespace Modules\User\Tests\Feature\Ad\AdContact;

use Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Modules\User\Entities\Ad;
use Modules\User\Entities\Ad\AdContact;
use Modules\User\Entities\Ad\AdContactType;
use Modules\User\Entities\AdPicture;
use Modules\User\Entities\User;

class AddContactTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        Sanctum::actingAs($this->user);
        Artisan::call("module:seed User");
    }

    public function test_if_can_add_contact_and_get_verification_code()
    {

        $ad = Ad::factory([
            'user_id' => $this->user->id,
        ])->create();

        $pictures = AdPicture::factory(3)->make();

        $ad->pictures()->saveMany($pictures);

        $response = $this->post(route('user.ad.step_phone_contact.add', [
            'contact_type' => AdContactType::whereName(AdContactType::TYPE_EMAIL)->first()->toArray(),
            'value' => 'mdhesari99@gmail.com',
        ]));

        $response->assertSessionHas(AdContact::VERIFICATION_SESSION);

        $response->assertJson([
            'confirmation_send_status' => true,
        ]);

        $response->assertSuccessful();
    }
}
