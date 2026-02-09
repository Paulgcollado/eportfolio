<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComentariosResource;
use App\Models\Comentarios;
use App\Models\Evidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Evidencia $evidencia)
    {
        $familiasProfesionalesId = DB::table('familias_profesionales')->pluck("id")->toArray();
        $fake = fake()->randomElement($familiasProfesionalesId);

        return ComentariosResource::collection(
            Comentarios::where('evidencia_id', $evidencia->id)
                ->orderBy($request->_sort ?? 'id', $request->_order ?? 'asc')
                ->paginate($request->perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Evidencia $evidencia)
    {
        $comentarioData = json_decode($request->getContent(), true);
        $comentarioData['evidencia_id'] = $evidencia->id;

        $comentario = Comentarios::create($comentarioData);
        return new ComentariosResource($comentario);
    }

    /**
     * Display the specified resource.
     */
    public function show(Evidencia $evidencia, Comentarios $comentario)
    {
        abort_if($comentario->evidencia_id !== $evidencia->id, 404);
        return new ComentariosResource($comentario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evidencia $evidencia, Comentarios $comentario)
    {
        abort_if($comentario->evidencia_id !== $evidencia->id, 404);

        $comentarioData = json_decode($request->getContent(), true);
        $comentario->update($comentarioData);

        return new ComentariosResource($comentario);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evidencia $evidencia, Comentarios $comentario)
    {
        try {
            abort_if($comentario->evidencia_id !== $evidencia->id, 404);
            $comentario->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
