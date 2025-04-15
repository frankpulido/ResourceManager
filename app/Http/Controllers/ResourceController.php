<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;

    /**
     * @OA\Info(
     *  title="Swagger Documentation for ResourceManager",
     *  version="1.0.0.0",
     *  description="Project ResourceManager documentation wall"
     * )
    */

class ResourceController extends Controller
{
    /**
     * @OA\Get(
     *  path="/api/resources",
     *  summary="Get all resources",
     *  tags={"Resources"},
     *  description="Returns a list of all resources",
     *  @OA\Response(
     *     response=200,
     *     description="Resource list",
     *     @OA\JsonContent(
     *      type="array",
     *      @OA\Items(ref="#/components/schemas/Resource")
     *      )
     *     )
     * )
    */

    public function index()
    {
        $resources = Resource::all();
        return response()->json($resources, 200);
    }
}
