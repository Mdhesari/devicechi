<?php

namespace Modules\User\Tests\Unit\Ad\Repository;

use App\Models\Ad;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Entities\PhoneModel;
use Modules\User\Entities\User;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

class AdRepositoryTest extends TestCase
{

    public function setUp(): void
    {

        parent::setUp();

        $this->artisan('module:seed');

        $this->user = User::factory()->create();
        $this->repository = app(AdRepositoryInterface::class);
    }

    public function test_step_choose_model()
    {

        $step = AdRepositoryInterface::STEP_CHOOSE_MODEL;

        $result = $this->repository->checkPreviousSteps($step, $this->user);

        $this->assertArrayHasKey('url', $result);

        $this->assertNull($result['url']);
    }

    public function test_step_choose_variant_without_model_should_return_uri()
    {

        $step = AdRepositoryInterface::STEP_CHOOSE_VARIANT;

        $result = $this->repository->checkPreviousSteps($step, $this->user);

        $this->assertArrayHasKey('url', $result);

        $this->assertEquals(route('user.ad.create'), $result['url']);
    }

    public function test_step_choose_age_wihtout_variant_should_return_variant_uri()
    {

        $phone_model = PhoneModel::first();

        $this->repository->create([
            'user_id' => $this->user->id,
            'phone_model_id' => $phone_model->id,
        ]);

        $step = AdRepositoryInterface::STEP_CHOOSE_AGE;

        $result = $this->repository->checkPreviousSteps($step, $this->user);

        $this->assertArrayHasKey('url', $result);

        $this->assertEquals(route('user.ad.step_phone_model_variant', [
            'phone_model' => $phone_model->name,
        ]), $result['url']);
    }
}
