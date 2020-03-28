<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Modules\User\Tests\Utilities\UserUtilities;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * @var UserUtilities
     */
    protected $userUtilities;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userUtilities = new UserUtilities();
    }
}
