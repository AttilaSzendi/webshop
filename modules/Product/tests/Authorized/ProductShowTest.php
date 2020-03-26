<?php

namespace Modules\Product\Tests\Authorized;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Modules\Product\Models\Product;
use Modules\User\Models\User;
use Tests\TestCase;

class ProductShowTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_product_cannot_be_retrieved_by_guests()
    {
        $product = factory(Product::class)->create();

        $response = $this->json('get', route('authorized::product.show', $product->id));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }


    /**
     * @test
     */
    public function a_product_can_be_retrieved()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($rawPassword = 'jelszo')
        ]);

        $product = factory(Product::class)->create();

        $response = $this->json('POST', route('authorized::product.show', $product->id));

//        $response->assertJsonStructure([
//            'token_type',
//            'expires_in',
//            'access_token',
//            'refresh_token',
//        ]);

        $response->assertStatus(Response::HTTP_OK);
    }


}
