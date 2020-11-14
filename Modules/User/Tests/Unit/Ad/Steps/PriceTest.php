<?php

namespace Modules\User\Tests\Unit\Ad\Steps;

use Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Entities\Ad;
use Modules\User\Entities\User;

class PriceTest extends TestCase
{

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_price()
    {

        $price = 1234567890; // 10 total digits;

        $ad = $this->user->ads()->create([
            'price' => $price,
        ]);

        $ad->refresh();

        $this->assertEquals($price, $ad->price);
    }

    public function test_max_price()
    {

        $price = 1234567891.34; // 12 total digits;

        $ad = $this->user->ads()->create([
            'price' => $price,
        ]);

        $ad->refresh();

        $this->assertEquals($price, $ad->price);
    }

    public function test_min_price()
    {

        $price = 1;

        $ad = $this->user->ads()->create([
            'price' => $price,
        ]);

        $ad_2 = $this->user->ads()->insert([
            'user_id' => $this->user->id,
            'price' => $price,
        ]);

        $ad->refresh();

        $this->assertEquals($price, $ad->price);
    }

    public function test_invalid_price()
    {
        $this->expectException(Exception::class);

        $price = 'invalid_data_type';

        $this->user->ads()->create([
            'price' => $price,
        ]);
    }


    public function test_invalid_price_max()
    {
        $this->expectException(Exception::class);

        $price = 123456789101; // 12 total digits;

        $this->user->ads()->create([
            'price' => $price,
        ]);
    }
}
