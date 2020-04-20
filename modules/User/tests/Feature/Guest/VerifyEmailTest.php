<?php

namespace Modules\User\Tests\Feature\Guest;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Modules\User\Http\Controllers\Guest\Auth\VerifyEmailController;
use Modules\User\Models\User;
use Tests\TestCase;

class VerifyEmailTest extends TestCase
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
    public function a_user_can_verify_its_email()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['email_verified_at' => null]);

        $hash = sha1($user->getEmailForVerification());

        $this->json('get', route('email.verify', [$user->id, $hash]));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'email_verified_at' => null
        ]);

        Event::assertDispatched(Verified::class);
    }

    /**
     * @test
     */
    public function a_user_cannot_verify_its_email_again()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['email_verified_at' => now()->subDay()]);

        $hash = sha1($user->getEmailForVerification());

        $response = $this->json('get', route('email.verify', [$user->id, $hash]));

        $response->assertStatus(Response::HTTP_BAD_REQUEST);

        $response->assertJson(['message' => VerifyEmailController::ALREADY_VERIFIED_EMAIL]);

        Event::assertNotDispatched(Verified::class);
    }

    /**
     * @test
     */
    public function a_user_cannot_verify_its_email_with_invalid_hash()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['email_verified_at' => now()->subDay()]);

        $hash = 'asd123';

        $response = $this->json('get', route('email.verify', [$user->id, $hash]));

        $response->assertStatus(Response::HTTP_FORBIDDEN);

        $response->assertJson(['message' => 'This action is unauthorized.']);

        Event::assertNotDispatched(Verified::class);
    }
}
