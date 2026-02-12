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
    public function index(Request $request, CriterioEvaluacion $criterios)
    {
        return TareaResource::collection(
            $criterios->tareas()
                ->orderBy($request->_sort ?? 'id', $request->_order ?? 'asc')
                ->paginate($request->per_page)
        );
    }

    public function tareasByRA(Request $request, ResultadoAprendizaje $resultadoAprendizaje)
    {
        $criteriosIds = CriterioEvaluacion::where('resultado_aprendizaje_id', $resultadoAprendizaje->id)->pluck('id');
        return TareaResource::collection(
            Tarea::whereIn('criterios_evaluacion_id', $criteriosIds)
                ->orderBy($request->_sort ?? 'id', $request->_order ?? 'asc')
                ->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tarea = $request->validate([
            'criterios_evaluacion_id' => 'required|array',
            'fecha_apertura' => 'required',
            'fecha_cierre' => 'required',
            'activo' => 'required'
        ]);

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
            return response()->json(['message' => 'Tarea eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
