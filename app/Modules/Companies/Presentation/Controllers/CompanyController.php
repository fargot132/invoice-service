<?php

declare(strict_types=1);

namespace App\Modules\Companies\Presentation\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Companies\Application\Queries\FindCompanyByIdQuery;
use App\Modules\Companies\Infrastructure\Exceptions\CompanyNotFoundException;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    public function __construct(private Dispatcher $dispatcher)
    {
    }

    public function show(string $id): JsonResponse
    {
        try {
            $company = $this->dispatcher->until(new FindCompanyByIdQuery($id));
            return response()->json($company);
        } catch (CompanyNotFoundException $e) {
            return response()->json(['error' => 'Company not found for id: ' . $id], 404);
        }
    }
}
