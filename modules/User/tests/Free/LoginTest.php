<?php

namespace Modules\User\Tests\Free;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Modules\User\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_access_token_can_be_retrieved_with_the_proper_credentials()
    {
        $user = factory(User::class)->create(['password' => bcrypt($rawPassword = 'jelszo')]);

        $response = $this->json('POST', route('login'), [
            'email' => $user->email,
            'password' => $rawPassword,
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function an_access_token_cannot_be_retrieved_without_the_proper_credentials()
    {
        $user = factory(User::class)->create();

        $response = $this->json('POST', route('login'), [
            'username' => $user->email,
            'password' => 'wrongPassword'
        ]);

        $response->assertJsonFragment(['error' => 'invalid.credentials']);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
