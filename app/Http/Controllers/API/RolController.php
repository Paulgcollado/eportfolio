<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RolResource;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Rol $rol)
    {
        $query = Rol::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return RolResource::collection(
            $query->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
                ->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rol = $request->validate([
            'name' => 'required|unique:roles,name',
            'description' => 'required'
        ]);

        $rol = Rol::create($rol);
        return new RolResource($rol);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        return new RolResource($rol);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rol $rol)
    {
        $rolData = json_decode($request->getContent(), true);
        $rol->update($rolData);
        return new RolResource($rol);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rol $rol)
    {
        try {
            $rol->delete();
            return response()->json(['message' => 'Rol eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
