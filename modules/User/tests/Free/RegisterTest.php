<?php


namespace Modules\User\Tests\Free;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_user_can_register()
    {
        Event::fake();

        $response = $this->json('POST', route('register'), [
            'name' => $name = 'test name',
            'email' => $email = 'asd@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertDatabaseHas('users', [
            'id' => 1,
            'name' => $name,
            'email' => $email,
        ]);

        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'created_at',
            'updated_at',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }
}
