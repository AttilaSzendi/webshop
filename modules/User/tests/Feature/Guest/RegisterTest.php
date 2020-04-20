<?php

namespace Modules\User\Tests\Feature\Guest;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Modules\User\Events\UserHasRegistered;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();
    }

    /**
     * @test
     */
    public function a_user_can_register()
    {
        $response = $this->json('POST', route('register'), [
            'name' => $name = 'test name',
            'email' => $email = 'asd@gmail.com',
            'password' => 'password',
            'passwordConfirmation' => 'password',
            'registeredAt' => 'http://anyting.com'
        ]);

        $this->assertDatabaseHas('users', [
            'id' => 1,
            'name' => $name,
            'email' => $email,
        ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'createdAt',
                'updatedAt',
            ]
        ]);

        Event::assertDispatched(UserHasRegistered::class);

        $response->assertStatus(Response::HTTP_CREATED);
    }


    /**
     * @test
     */
    public function the_registration_should_fail_if_the_given_data_is_invalid()
    {
        $response = $this->json('POST', route('register'), [
            'name' => '',
            'email' => '',
            'password' => '',
            'passwordConfirmation' => '',
            'registeredAt' => ''
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
