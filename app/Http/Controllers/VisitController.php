<?php

namespace App\Http\Controllers;

use App\Constants\General;
use App\Http\Requests\VisitRequest;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        $visits = Visit::orderBy('created_at', 'desc')->paginate(General::ROW_PER_PAGE);
        return response()->json($visits, 200);
    }

    public function store(VisitRequest $request)
    {
        $validated = $request->validated();
        $visit = Visit::create($validated);

        return response()->json($visit, 201);
    }

    public function show(Visit $visit)
    {
        return $visit;
    }

    public function update(VisitRequest $request, Visit $visit)
    {
        $validated = $request->validated();
        $visit->update($validated);

        return response()->json($visit);
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();

        return response()->json(null, 204);
    }
}
