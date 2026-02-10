<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CicloFormativoResource;
use App\Models\CicloFormativo;
use App\Models\FamiliaProfesional;
use Illuminate\Http\Request;

class CiclosFormativosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, FamiliaProfesional $familiaProfesional)
    {
        $query = CicloFormativo::query();

        if ($request->search) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        return CicloFormativoResource::collection(
            $query->where('familia_profesional_id', $familiaProfesional->id)
                ->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
                ->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FamiliaProfesional $familiaProfesional)
    {
        abort_if ($request->user()->cannot('create', CicloFormativo::class), 403);

        $ciclo = $request->validate([
            'nombre' => 'required',
            'codigo' => 'required|unique:ciclos_formativos,codigo|max:255',
            'grado' => 'required|in:basico,medio,superior',
            'descripcion' => 'required'
        ]);

        $ciclo['familia_profesional_id'] = $familiaProfesional->id;
        $ciclo = CicloFormativo::create($ciclo);
        return new CicloFormativoResource($ciclo);
    }

    /**
     * Display the specified resource.
     */
    public function show(FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        abort_if($cicloFormativo->familia_profesional_id !== $familiaProfesional->id, 404, "No se encuentra la evidencia");
        return new CicloFormativoResource($cicloFormativo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        abort_if ($request->user()->cannot('update', $cicloFormativo), 403);
        abort_if($cicloFormativo->familia_profesional_id !== $familiaProfesional->id, 404, "No se encuentra la evidencia");

        $cicloData = json_decode($request->getContent(), true);
        $cicloFormativo->update($cicloData);
        return new CicloFormativoResource($cicloFormativo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, FamiliaProfesional $familiaProfesional, CicloFormativo $cicloFormativo)
    {
        abort_if ($request->user()->cannot('delete', $cicloFormativo), 403);
        abort_if($cicloFormativo->familia_profesional_id !== $familiaProfesional->id, 404, "No se encuentra la evidencia");

        try {
            $cicloFormativo->delete();
            return response()->json(['message' => 'CicloFormativo eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
