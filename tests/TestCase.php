<?php

namespace Tests;

use Event;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Notification;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,
        DatabaseMigrations,
        WithFaker,
        DatabaseTransactions;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        Notification::fake();
    }

    /**
     * Set the URL of the previous request.
     *
     * @param  string  $url
     * @return $this
     */
    public function from(string $url)
    {
        $this->app['session']->setPreviousUrl($url);

        return $this;
    }
}
