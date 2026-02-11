<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return UserResource::collection(
            $query->orderBy($request->sort ?? 'id', $request->order ?? 'asc')
                ->paginate($request->per_page)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $userData = json_decode($request->getContent(), true);
        $user->update($userData);
        return new UserResource($user);
    }

    // OBTENER INFORMACIÓN DEL USUARIO AUTENTICADO.
    public function authUser(Request $request)
    {
        // OBTENER USUARIO AUTENTICADO
        $user = $request->user();

        // CREAR UN ARRAY DE ROLES Y ASIGNAR ROLES DEPENDIENDO DE SI ES ADMINISTRADOR, DOCENTE O ESTUDIANTE.
        $roles = [];
        if ($user->esAdministrador()) {
            array_push($roles, 'administrador');
        }
        if ($user->esDocente()) {
            array_push($roles, 'docente');
        }
        if ($user->esEstudiante()) {
            array_push($roles, 'estudiante');
        }

        // DEVOLVER EL RECURSO DEL USUARIO, PERO CON EL ARRAY ROLES AÑADIDO DE FORMA ADICIONAL.
        return new UserResource($user)->additional([
            "roles" => $roles
        ]);
    }
}
