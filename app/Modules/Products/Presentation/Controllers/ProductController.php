<?php

declare(strict_types=1);

namespace App\Modules\Products\Presentation\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Products\Application\Queries\FindProductByIdQuery;
use App\Modules\Products\Infrastructure\Exceptions\ProductNotFoundException;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(private Dispatcher $dispatcher)
    {
    }
    public function show(string $id): JsonResponse
    {
        try {
            $product = $this->dispatcher->until(new FindProductByIdQuery($id));
            return response()->json($product);
        } catch (ProductNotFoundException $e) {
            return response()->json(['error' => 'Product not found for id: ' . $id], 404);
        }
    }
}
