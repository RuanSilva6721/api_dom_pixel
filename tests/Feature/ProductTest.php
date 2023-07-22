<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;


class ProductTest extends TestCase
{
    protected string $endpoint = '/api/applianceProduct';

    use RefreshDatabase;

    public function test_create_product()
    {

        $payload = [
            'name' => 'accusamus',
            'description' => 'Sequi et in est beatae.',
            'price' => 10.99,
            'stock_quantity' => 50
        ];

        $response = $this->postJson($this->endpoint . 'Create', $payload);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_find()
    {
        $product = Product::factory()->create();

        $response = $this->getJson("{$this->endpoint}/{$product->id}");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'id',
            'name',
            'description',
            'price',
            'stock_quantity'
        ]);
    }

    public function test_update()
    {
            $product = Product::factory()->create();

            $payload = [
                'name' => 'Updated Product',
                'description' => 'This is the updated product',
                'price' => 15.99,
                'stock_quantity' => 100
            ];

            $response = $this->putJson("{$this->endpoint}/{$product->id}", $payload);


            $response->assertStatus(Response::HTTP_OK);
    }

    public function test_update_not_found()
    {
        $response = $this->putJson("{$this->endpoint}/fake_id", [
            'name' => 'Updated Product'
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_delete_not_found()
    {
        $response = $this->deleteJson("{$this->endpoint}/fake_id");

        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function test_delete()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("{$this->endpoint}/{$product->id}");

        $response->assertNoContent();
    }
}
