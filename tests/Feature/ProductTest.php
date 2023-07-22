<?php

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class ProductTest extends TestCase
{
    protected string $endpoint = '/api/applianceProduct';

    use RefreshDatabase;


    public function test_create_product()
    {
        Brand::factory(10)->create();

        $brand =Brand::first();
        $payload = [
            'name' => 'accusamus',
            'description' => 'Sequi et in est beatae.',
            'voltage' => '110v',
            'brand_id' => $brand->id,
        ];

        $response = $this->postJson($this->endpoint.'Create', $payload);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_find()
    {
        Brand::factory(10)->create();

        $product = Product::factory()->create();

        $response = $this->getJson("{$this->endpoint}/{$product->id}");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
    
                'id',
                'name',
                'description',
                'voltage',
                'brand_id',
                'created_at',
                'updated_at'
            
        ]);
    }

    // public function test_find_not_found()
    // {
    //     $response = $this->getJson("{$this->endpoint}/fake_id");

    //     $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
    // }

    public function test_update()
    {

        DB::beginTransaction();
         Brand::factory(10)->create();

        try {
            $product = Product::factory()->create();

            $payload = [
                'name' => 'Updated Product',
                'description' => 'This is the updated product',
                'voltage' => '220v',
                'brand_id' => $product->brand_id
            ];

            $response = $this->putJson("{$this->endpoint}/{$product->id}", $payload);

            $response->assertStatus(Response::HTTP_OK);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function test_update_not_found()
    {
        $response = $this->putJson("{$this->endpoint}/fake_id", [
            'name' => 'Updated Product'
        ]);

        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function test_delete_not_found()
    {
        $response = $this->deleteJson("{$this->endpoint}/fake_id");

        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function test_delete()
    {
        Brand::factory(10)->create();
        $product = Product::factory()->create();

        $response = $this->deleteJson("{$this->endpoint}/{$product->id}");

        $response->assertNoContent();
    }
}
