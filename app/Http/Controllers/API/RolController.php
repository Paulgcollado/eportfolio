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
        return RolResource::collection(
            Rol::orderBy($request->sort ?? 'id', $request->order ?? 'asc')->paginate($request->per_page)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rol = json_decode($request->getContent(), true);
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
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}
