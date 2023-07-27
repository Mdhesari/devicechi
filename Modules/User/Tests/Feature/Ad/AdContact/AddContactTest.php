<?php

namespace Modules\User\Tests\Feature\Ad\AdContact;

use Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use App\Models\Ad;
use App\Models\Ad\AdContact;
use App\Models\Ad\AdContactType;
use Modules\User\Entities\User;
use Symfony\Component\CssSelector\Node\FunctionNode;

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

        $response = $this->createAdIncludingAddContactResponse();

        $response->assertSessionHas(AdContact::VERIFICATION_SESSION);

        $response->assertJson([
            'status' => true,
        ]);

        $response->assertSuccessful();
    }

    public function test_if_can_verify_contact()
    {

        $response = $this->createAdIncludingAddContactResponse();

        $response->assertSuccessful();

        $verification_code = session('test_code');

        $ad_contact = AdContact::first();

        $this->assertTrue($ad_contact->isNotVerified());

        $response = $this->put(route('user.ad.step_phone_contact.verify'), [
            '_method' => 'put',
            'ad_contact_id' => $ad_contact->id,
            'verification_code' => $verification_code,
        ]);

        $ad_contact->refresh();

        $this->assertFalse($ad_contact->isNotVerified());

        $response->assertSuccessful();
    }


    public function test_if_can_go_to_next_step_from_contact_without_stored_contacts()
    {

        $response = $this->createAdIncludingAddContactResponse();

        $this->user->ads()->first()->contacts()->delete();

        $this->user->push();

        $response = $this->post(route('user.ad.step_phone_contact'));

        $response->assertSessionHasErrors();

        $response->assertRedirect();
    }

    private function createAdIncludingAddContactResponse()
    {

        $ad = Ad::factory([
            'user_id' => $this->user->id,
        ])->create();

        // $pictures = AdPicture::factory(3)->make();

        // $ad->pictures()->saveMany($pictures);

        $response = $this->post(route('user.ad.step_phone_contact.add', [
            'contact_type' => AdContactType::whereName(AdContactType::TYPE_EMAIL)->first()->toArray(),
            'value' => 'mdhesari99@gmail.com',
        ]));

        return $response;
    }
}
