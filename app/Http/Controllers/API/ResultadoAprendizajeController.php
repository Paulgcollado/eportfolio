<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResultadoAprendizajeResource;
use App\Models\ModuloFormativo;
use App\Models\ResultadoAprendizaje;
use Illuminate\Http\Request;

class ResultadoAprendizajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ModuloFormativo $moduloFormativo)
    {
        $query = ResultadoAprendizaje::query();

        if ($request->search) {
            $query->where('descripcion', 'like', '%' . $request->search . '%');
        }

        return ResultadoAprendizajeResource::collection(
            $query->where('modulo_formativo_id', $moduloFormativo->id)
                ->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
                ->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ModuloFormativo $moduloFormativo)
    {
        $resultadoAprendizaje = $request->validate([
            'codigo' => 'required|unique:resultados_aprendizaje,codigo',
            'descripcion' => 'required',
            'peso_porcentaje' => 'required',
            'orden' => 'required',
        ]);

        $resultadoAprendizaje['modulo_formativo_id'] = $moduloFormativo->id;

        $resultadoAprendizaje = ResultadoAprendizaje::create($resultadoAprendizaje);
        return new ResultadoAprendizajeResource($resultadoAprendizaje);
    }

    /**
     * Display the specified resource.
     */
    public function show(ModuloFormativo $moduloFormativo, ResultadoAprendizaje $resultadoAprendizaje)
    {
        abort_if($resultadoAprendizaje->modulo_formativo_id !== $moduloFormativo->id, 404, "No se encuentra el resultado de aprendizaje");
        return new ResultadoAprendizajeResource($resultadoAprendizaje);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModuloFormativo $moduloFormativo, ResultadoAprendizaje $resultadoAprendizaje)
    {
        abort_if($resultadoAprendizaje->modulo_formativo_id !== $moduloFormativo->id, 404, "No se encuentra el resultado de aprendizaje");

        $resultadoAprendizajeData = json_decode($request->getContent(), true);
        $resultadoAprendizaje->update($resultadoAprendizajeData);
        return new ResultadoAprendizajeResource($resultadoAprendizaje);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModuloFormativo $moduloFormativo, ResultadoAprendizaje $resultadoAprendizaje)
    {
        abort_if($resultadoAprendizaje->modulo_formativo_id !== $moduloFormativo->id, 404, "No se encuentra el resultado de aprendizaje");
        try {
            $resultadoAprendizaje->delete();
            return response()->json(['message' => 'ResultadoAprendizaje eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
