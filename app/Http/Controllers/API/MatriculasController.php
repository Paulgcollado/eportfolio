<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatriculaResource;
use App\Http\Resources\ModuloFormativoResource;
use App\Models\Matricula;
use App\Models\ModuloFormativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatriculasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return MatriculaResource::collection(
            Matricula::orderBy($request->sort ?? 'id', $request->order ?? 'asc')
            ->paginate($request->per_page));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $matricula = json_decode($request->getContent(), true);
        $matricula = Matricula::create($matricula);
        return new MatriculaResource($matricula);
    }

    // Devuelve una colección de módulos formativos en los que el usuario autenticado tiene matrícula.
    public function modulosMatriculados(Request $request)
    {
        // Usuario autenticado.
        $user = Auth::user();

        // Matrículas donde el estudiante es el id del usuario autenticado.
        $matriculas = Matricula::where("estudiante_id", $user->id)->get();

        // Modulos formativos cuyo estudiante id es
        return ModuloFormativoResource::collection(
            ModuloFormativo::where("id", $matriculas->modulo_formativo_id)
                ->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
                ->paginate($request->per_page)
        );
    }


    /**
     * Display the specified resource.
     */
    public function show(Matricula $matricula)
    {
        return new MatriculaResource($matricula);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matricula $matricula)
    {
        $matriculaData = json_decode($request->getContent(), true);
        $matricula->update($matriculaData);
        return new MatriculaResource($matricula);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matricula $matricula)
    {
        try {
            $matricula->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
