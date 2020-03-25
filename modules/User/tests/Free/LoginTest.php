<?php

namespace Modules\User\Tests\Free;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Modules\User\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_registered_user_can_ask_for_an_auth_token()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($rawPassword = 'jelszo')
        ]);

        $client = $this->makeClient();

        $response = $this->json('POST', route('login'), [
            'username' => $user->email,
            'password' => $rawPassword,
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret
        ]);

        $response->assertJsonStructure([
            'token_type',
            'expires_in',
            'access_token',
            'refresh_token',
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function a_registered_user_should_get_bad_request_exception_if_the_credentials_are_wrong()
    {
        $user = factory(User::class)->create();

        $client = $this->makeClient();

        $response = $this->json('POST', route('login'), [
            'username' => $user->email,
            'password' => 'wrongPassword',
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    /**
     * @test
     */
    public function a_not_registered_user_cannot_ask_for_an_auth_token()
    {
        $client = $this->makeClient();

        $response = $this->json('POST', route('login'), [
            'username' => 'asd@gmail.com',
            'password' => 'anything',
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function makeClient()
    {
        Artisan::call('passport:install');

        return DB::table('oauth_clients')->where('id', 2)->first();
    }
}
