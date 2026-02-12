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
    public function index(Request $request, ModuloFormativo $moduloFormativo)
    {
        return MatriculaResource::collection(
            Matricula::where('modulo_formativo_id', $moduloFormativo->id)
                ->orderBy($request->sort ?? 'estudiante_id', $request->order ?? 'asc')
                ->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ModuloFormativo $moduloFormativo)
    {
        $user = $request->user();

        $matricula = Matricula::create([
            'estudiante_id' => $user->id,
            'modulo_formativo_id' => $moduloFormativo->id
        ]);

        return new MatriculaResource($matricula);
    }

    // Devuelve una colección de módulos formativos en los que el usuario autenticado tiene matrícula.
    public function modulosMatriculados(Request $request)
    {
        $user = $request->user();
        $matriculas = $user->modulosMatriculados;
        return MatriculaResource::collection($matriculas);
    }


    /**
     * Display the specified resource.
     */
    public function show(ModuloFormativo $moduloFormativo, Matricula $matricula)
    {
        abort_if($matricula->modulo_formativo_id !== $moduloFormativo->id, 404, "No se encuentra la matrícula");
        return new MatriculaResource($matricula);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModuloFormativo $moduloFormativo, Matricula $matricula)
    {
        abort_if($matricula->modulo_formativo_id !== $moduloFormativo->id, 404, "No se encuentra la matrícula");
        $matriculaData = json_decode($request->getContent(), true);
        $matricula->update($matriculaData);
        return new MatriculaResource($matricula);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModuloFormativo $moduloFormativo, Matricula $matricula)
    {
        abort_if($matricula->modulo_formativo_id !== $moduloFormativo->id, 404, "No se encuentra la matrícula");
        try {
            $matricula->delete();
            return response()->json(['message' => 'Matricula eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }

    public function matriculasLote(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'estudiantes_id' => 'sometimes|array',
            'modulos_formativos_id' => 'required|array'
        ]);

        $matriculas = [];
        if ($user->esAdministrador()) {
            $matriculas = $this->generarMatriculasAdmin($validated);
        } else {
            $matriculas = $this->generarMatriculasEstudiante($validated['modulos_formativos_id'], $user);
        }

        return MatriculaResource::collection($matriculas);
    }

    /**
     * GENERAR MATRÍCULAS COMO ADMINISTRADOR IMPLICA QUE PUEDE CREAR INFINITAS.
     */
    private function generarMatriculasAdmin($data)
    {
        $estudiantesIds = $data['estudiantes_id'];
        $modulosIds = $data['modulos_formativos_id'];

        $loteMatriculas = [];
        foreach ($estudiantesIds as $estudiante) {
            foreach ($modulosIds as $modulo) {
                $matricula = Matricula::create([
                    'estudiante_id' => $estudiante,
                    'modulo_formativo_id' => $modulo
                ]);
                array_push($loteMatriculas, $matricula);
            }
        }

        return $loteMatriculas;
    }

    /**
     * GENERAR MATRÍCULAS SIN SER ADMINISTRADOR IMPLICA QUE EL USUARIO SE MATRICULA HASTA UN NÚMERO DEFINIDO DE MODULOS.
     */
    private function generarMatriculasEstudiante($modulos, $user)
    {
        // LIMITAR HASTA LOS 5 PRIMEROS LOTES DE MATRÍCULAS
        $limit = config('app.max_modulos_matricula', 5);
        $modulos = array_slice($modulos, 0, $limit);

        $loteMatriculas = [];
        foreach ($modulos as $modulo) {
            $matricula = Matricula::create([
                'estudiante_id' => $user->id,
                'modulo_formativo_id' => $modulo
            ]);
            array_push($loteMatriculas, $matricula);
        }

        return $loteMatriculas;
    }
}
