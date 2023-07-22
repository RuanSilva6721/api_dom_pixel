<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

class ProductController extends Controller
{
    private $productService;
    private $logger;

    public function __construct(ProductService $productService, LoggerInterface $logger)
    {
        $this->productService = $productService;
        $this->logger = $logger;
    }

    public function getProductAll()
    {
        try {
            $products = $this->productService->getProductAll();
            return new JsonResponse($products);
        } catch (Exception $e) {
            $this->logError($e);
            return new JsonResponse([
                'error' => true,
                'message' => 'Ocorreu um erro ao obter os produtos.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function getProductOne($id)
    {
        try {
            return $this->productService->getProductOne($id);
        } catch (Exception $e) {
            $this->logError($e);
            return new JsonResponse([
                'error' => true,
                'message' => 'Ocorreu um erro ao obter o produto.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function getProductOfBrand($id)
    {
        try {
            return $this->productService->getProductOfBrand($id);
        } catch (Exception $e) {
            $this->logError($e);
            return new JsonResponse([
                'error' => true,
                'message' => 'Ocorreu um erro ao obter o produtos.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function createProduct(Request $request)
    {
        try {
            $result = $this->productService->createProduct($request);
            if ($result) {
                return new JsonResponse([
                    'success' => true,
                    'message' => 'Produto criado com sucesso.'
                ],201);
            } else {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Não foi possível criar o produto.'
                ], 500);
            }
        } catch (\Exception $e) {
            $this->logError($e);
            return new JsonResponse([
                'error' => true,
                'message' => 'Ocorreu um erro ao criar o produto.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function editProduct($id, Request $request)
    {
        try {
            $result = $this->productService->editProduct($id, $request);
            if ($result) {
                return new JsonResponse([
                    'success' => true,
                    'message' => 'Produto editado com sucesso.'
                ]);
            } else {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Não foi possível encontrar o produto para edição.'
                ], 404);
            }
        } catch (Exception $e) {
            $this->logError($e);
            return new JsonResponse([
                'error' => true,
                'message' => 'Ocorreu um erro ao editar o produto.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteProduct($id)
    {
        try {
            $result = $this->productService->deleteProduct($id);
            if ($result) {
                return new JsonResponse([
                    'success' => true,
                    'message' => 'Produto excluído com sucesso.'
                ], 204);
            } else {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Não foi possível encontrar o produto para exclusão.'
                ], 404);
            }
        } catch (Exception $e) {
            $this->logError($e);
            return new JsonResponse([
                'error' => true,
                'message' => 'Ocorreu um erro ao excluir o produto.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    private function logError(Exception $exception)
    {
        $this->logger->error('Erro no controlador ProductController', [
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);
    }
}
