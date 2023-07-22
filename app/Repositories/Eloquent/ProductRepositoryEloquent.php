<?php
namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;


class ProductRepositoryEloquent implements ProductRepository
{

    public function getProductAll()
    {

        return Product::orderBy('name')->get();;
    }
    public function getProductOne($id)
    {

        return Product::find($id);
    }
    
    public function createProduct($user)
    {

        $product = new Product();
        return $product->create($user);
    }
    public function editProduct($id, $user)
    {
        $product = Product::find($id);
        return $product->update($user);

    }
    public function deleteProduct($id)
    {

        $product = Product::find($id);
        return $product->delete();
    }
}
