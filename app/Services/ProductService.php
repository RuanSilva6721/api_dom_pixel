<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProductService
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }
    public function getProductAll()
    {
        return $this->productRepository->getProductAll();
    }
    public function getProductOne($id)
    {
        return $this->productRepository->getProductOne($id);
    }
    public function getProductOfBrand($id)
    {
        return $this->productRepository->getProductOfBrand($id);
    }
    
    public function createProduct($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|between:0.01,999999.99',
            'stock_quantity' => 'required|integer|min:0'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        $productData = $request->all();
        return $this->productRepository->createProduct($productData);
    }

    public function editProduct($id, $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|between:0.01,999999.99',
            'stock_quantity' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        $productData = $request->all();
        return $this->productRepository->editProduct($id, $productData);
    }
    public function deleteProduct($id)
    {
        return $this->productRepository->deleteProduct($id);
    }
}
