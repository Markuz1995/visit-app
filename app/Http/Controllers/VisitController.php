<?php

namespace App\Http\Controllers;

use App\Constants\General;
use App\Http\Requests\VisitRequest;
use App\Models\Visit;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Visits",
 *     description="API Endpoints of Visits"
 * )
 */
class VisitController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/visits",
     *     summary="Get list of visits",
     *     tags={"Visits"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Visit")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $visits = Visit::orderBy('created_at', 'desc')->paginate(General::ROW_PER_PAGE);
        return response()->json($visits, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/visits",
     *     summary="Create a new visit",
     *     tags={"Visits"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Visit")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Visit created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Visit")
     *     )
     * )
     */
    public function store(VisitRequest $request)
    {
        $validated = $request->validated();
        $visit = Visit::create($validated);

        return response()->json($visit, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/visits/{id}",
     *     summary="Get visit details",
     *     tags={"Visits"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Visit ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Visit")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Visit not found"
     *     )
     * )
     */
    public function show(Visit $visit)
    {
        return response()->json($visit, 200);
    }

    /**
     * @OA\Put(
     *     path="/api/visits/{id}",
     *     summary="Update a visit",
     *     tags={"Visits"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Visit ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Visit")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Visit updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Visit")
     *     )
     * )
     */
    public function update(VisitRequest $request, Visit $visit)
    {
        $validated = $request->validated();
        $visit->update($validated);

        return response()->json($visit, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/visits/{id}",
     *     summary="Delete a visit",
     *     tags={"Visits"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Visit ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Visit deleted successfully"
     *     )
     * )
     */
    public function destroy(Visit $visit)
    {
        $visit->delete();

        return response()->json(null, 204);
    }
}
