<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModuloFormativoResource;
use App\Models\CicloFormativo;
use App\Models\ModuloFormativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuloFormativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, CicloFormativo $cicloFormativo)
    {
        $query = ModuloFormativo::query();

        if ($request->search) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        return ModuloFormativoResource::collection(
            $query->where('ciclo_formativo_id', $cicloFormativo->id)
                ->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
                ->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CicloFormativo $cicloFormativo)
    {
        $user = Auth::user();

        $modulo = $request->validate([
            'nombre' => 'required',
            'codigo' => 'required|unique:modulos_formativos,codigo',
            'horas_totales' => 'required',
            'curso_escolar' => 'required',
            'centro' => 'required',
            'descripcion' => 'required'
        ]);

        $modulo['ciclo_formativo_id'] = $cicloFormativo->id;
        $modulo['docente_id'] = $user->id;

        $modulo = ModuloFormativo::create($modulo);
        return new ModuloFormativoResource($modulo);
    }

    /**
     * Display the specified resource.
     */
    public function show(CicloFormativo $cicloFormativo, ModuloFormativo $moduloFormativo)
    {
        abort_if($moduloFormativo->ciclo_formativo_id !== $cicloFormativo->id, 404, "No se encuentra el módulo formativo");
        return new ModuloFormativoResource($moduloFormativo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CicloFormativo $cicloFormativo, ModuloFormativo $moduloFormativo)
    {
        abort_if($moduloFormativo->ciclo_formativo_id !== $cicloFormativo->id, 404, "No se encuentra el módulo formativo");
        $moduloData = json_decode($request->getContent(), true);
        $moduloFormativo->update($moduloData);
        return new ModuloFormativoResource($moduloFormativo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CicloFormativo $cicloFormativo, ModuloFormativo $moduloFormativo)
    {
        abort_if($moduloFormativo->ciclo_formativo_id !== $cicloFormativo->id, 404, "No se encuentra el módulo formativo");
        try {
            $moduloFormativo->delete();
            return response()->json(['message' => 'ModuloFormativo eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }

    public function modulosImpartidos(Request $request)
    {
        // USUARIO AUTENTICADO
        $user = Auth::user();

        // LISTAR LOS MÓDULOS EN LOS QUE EL USUARIO AUTENTICADO IMPARTE DOCENCIA.
        return ModuloFormativoResource::collection(
            ModuloFormativo::where('docente_id', $user->id)
                ->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
                ->paginate($request->per_page)
        );
    }
}
