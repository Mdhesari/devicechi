<?php

namespace Modules\User\Tests\Unit\Ad;

use App\Models\Ad;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Entities\User;

class CreateTest extends TestCase
{

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_if_can_initialize()
    {

        $ad = new Ad;
        $ad->model_id = 1;

        $this->user->ads()->save($ad);

        $this->assertDatabaseCount('ads', 1);
    }

    public function test_if_can_continue_step()
    {

        $ad = new Ad;
        $ad->model_id = 1;

        $this->user->ads()->save($ad);

        $ad = $this->user->ads()->whereStatus(3)->first();

        $ad->model_variant_id = 1;
        $ad->save();

        $ad = $this->user->ads()->whereStatus(3)->first();

        $this->assertNotNull($ad->model_variant_id);
    }

    public function test_if_can_finish_steps_go_to_pending_status()
    {

        $ad = new Ad;
        $ad->model_id = 1;

        $this->user->ads()->save($ad);

        $ad = $this->user->ads()->whereStatus(3)->first();

        $ad->model_variant_id = 1;
        $ad->age = 30;
        $ad->price = 7650000;
        $ad->city_id = 1;
        $ad->location = 'Iran, Tehran, Ekbatan phase 1';
        $ad->title = 'فروش گوشی اپل 5s';
        $ad->description = 'تازه خریدم و از اندروید بیشتر خوشم میاد.';
        $ad->meta_ad = [
            'title' => 'فروش گوشی موبایل',
            'description' => 'راحت و فوری',
        ];
        $ad->status = 2;
        $ad->save();

        $ad->refresh();

        $this->assertEquals(2, $ad->status);
    }
}
