<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CriteriosEvaluacionResource;
use App\Http\Resources\TareaResource;
use App\Models\CriterioEvaluacion;
use App\Models\ResultadoAprendizaje;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, CriterioEvaluacion $criterios, ResultadoAprendizaje $resultados)
    {
        if ($resultados->exists) {
            $criteriosIds = CriterioEvaluacion::where('resultado_aprendizaje_id', $resultados->id)->pluck('id');
            return TareaResource::collection(
                Tarea::whereIn('criterios_evaluacion_id', $criteriosIds)
                    ->orderBy($request->_sort ?? 'id', $request->_order ?? 'asc')
                    ->paginate($request->perPage)
            );
        }

        return TareaResource::collection(
            Tarea::where('criterios_evaluacion_id', $criterios->id)
                ->orderBy($request->_sort ?? 'id', $request->_order ?? 'asc')
                ->paginate($request->perPage)
        );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tarea = json_decode($request->getContent(), true);
        $tarea = Tarea::create($tarea);
        return new TareaResource($tarea);
    }

    /**
     * Display the specified resource.
     */
    public function show(CriterioEvaluacion $criterios, Tarea $tarea)
    {
        abort_if($tarea->criterios_evaluacion_id !== $criterios->id, 404, "No se encuentra la evidencia");
        return new TareaResource($tarea);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        $tareaData = json_decode($request->getContent(), true);
        $tarea->update($tareaData);
        return new TareaResource($tarea);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        try {
            $tarea->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
