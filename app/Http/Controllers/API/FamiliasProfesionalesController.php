<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FamiliaProfesionalResource;
use App\Models\FamiliaProfesional;
use Illuminate\Http\Request;

class FamiliasProfesionalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = FamiliaProfesional::query();

        if ($request->search) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        return FamiliaProfesionalResource::collection(
            $query->orderBy($request->sort ?? 'id', $request->order ?? 'asc')->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $familiaProfesional = $request->validate([
            'nombre' => 'required',
            'codigo' => 'required|unique:familias_profesionales,codigo',
            'descripcion' => 'required'
        ]);

        $familiaProfesional = FamiliaProfesional::create($familiaProfesional);
        return new FamiliaProfesionalResource($familiaProfesional);
    }

    /**
     * Display the specified resource.
     */
    public function show(FamiliaProfesional $familiaProfesional)
    {
        return new FamiliaProfesionalResource($familiaProfesional);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamiliaProfesional $familiaProfesional)
    {
        $familiaProfesionalData = json_decode($request->getContent(), true);
        $familiaProfesional->update($familiaProfesionalData);
        return new FamiliaProfesionalResource($familiaProfesional);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamiliaProfesional $familiaProfesional)
    {
        try {
            $familiaProfesional->delete();
            return response()->json(['message' => 'FamiliaProfesional eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
