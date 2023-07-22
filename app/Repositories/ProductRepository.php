<?php
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;


interface ProductRepository
{

    public function getProductAll();
    public function getProductOne($id);
    
    public function createProduct($user);
    public function editProduct($id, $user);
    public function deleteProduct($id);
}
