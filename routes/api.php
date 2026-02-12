<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Psr\Http\Message\ServerRequestInterface;
use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config\Config;
use App\Http\Controllers\API\ComentariosController;
use App\Http\Controllers\API\AsignacionesController;
use App\Http\Controllers\API\CiclosFormativosController;
use App\Http\Controllers\API\FamiliasProfesionalesController;
use App\Http\Controllers\API\CriteriosTareasController;
use App\Http\Controllers\API\EvaluacionEvidenciaController;
use App\Http\Controllers\API\EvidenciaController;
use App\Http\Controllers\API\TareasController;
use App\Http\Controllers\API\CriterioEvaluacionController;
use App\Http\Controllers\API\MatriculasController;
use App\Http\Controllers\API\ModuloFormativoController;
use App\Http\Controllers\API\ResultadoAprendizajeController;
use App\Http\Controllers\API\RolController;
use App\Http\Controllers\API\UserController;

// Rutas PHP-CRUD-API
Route::prefix('v1')->group(function () {

    // --------------------------------------------------
    // USERS
    Route::apiResource('users', UserController::class)->only("index", "show", "update");
    Route::middleware(['auth:sanctum'])->get('user', [UserController::class, 'authUser']);
    Route::get('docentes', [UserController::class, 'docentes']);
    Route::get('estudiantes', [UserController::class, 'estudiantes']);

    // --------------------------------------------------
    // ASIGNACIONES
    Route::apiResource('evidencias.asignaciones-revision', AsignacionesController::class);
    Route::get('users/{user_id}/asignaciones-revision', [AsignacionesController::class, 'asignacionUsuarios']);

    // --------------------------------------------------
    // CICLOS FORMATIVOS
    Route::apiResource('familias-profesionales.ciclos-formativos', CiclosFormativosController::class)
        ->parameters([
            'familias-profesionales' => 'familiaProfesional',
            'ciclos-formativos' => 'cicloFormativo'
        ]);

    // --------------------------------------------------
    // MODULOS FORMATIVOS
    Route::apiResource('ciclos-formativos.modulos-formativos', ModuloFormativoController::class)
        ->parameters([
            'ciclos-formativos' => 'cicloFormativo',
            'modulos-formativos' => 'moduloFormativo'
        ]);
    Route::middleware(['auth:sanctum'])->get('modulos-impartidos', [ModuloFormativoController::class, "modulosImpartidos"]);


    // --------------------------------------------------
    // COMENTARIOS
    Route::apiResource('evidencias.comentarios', ComentariosController::class);

    // --------------------------------------------------
    // TAREAS
    Route::apiResource('tareas', TareasController::class)->only('store', 'update', 'destroy');
    Route::apiResource('criterios-evaluacion.tareas', TareasController::class)->only('index', 'show')
        ->parameters(['criterios-evaluacion' => 'criterios']);
    Route::get('resultados-aprendizaje/{resultadoAprendizaje}/tareas', [TareasController::class, 'tareasByRA']);

    // --------------------------------------------------
    // EVIDENCIAS
    Route::apiResource('tareas.evidencias', EvidenciaController::class);
    Route::get('users/{parent_id}/evidencias', [EvidenciaController::class, 'showUserEvidencias']);

    // --------------------------------------------------
    // FAMILIAS PROFESIONALES
    Route::apiResource('familias-profesionales', FamiliasProfesionalesController::class)
        ->parameters([
            'familias-profesionales' => 'familiaProfesional'
        ]);

    // --------------------------------------------------
    // EVALUACION EVIDENCIAS
    Route::apiResource('evidencias.evaluaciones-evidencias', EvaluacionEvidenciaController::class)->parameters([
        'evaluaciones-evidencias' => 'evaluacionEvidencia'
    ]);

    // --------------------------------------------------
    // MATRICULAS
    Route::apiResource('modulos-formativos.matriculas', MatriculasController::class)->parameters([
        'modulos-formativos' => 'moduloFormativo',
        'matriculas' => 'matricula'
    ]);
    Route::middleware(['auth:sanctum'])->get('modulos-matriculados', [MatriculasController::class, "modulosMatriculados"]);
    Route::middleware(['auth:sanctum'])->post('matriculas', [MatriculasController::class, 'matriculasLote']);

    // --------------------------------------------------
    // RESULTADOS APRENDIZAJE
    Route::apiResource('modulos-formativos.resultados-aprendizaje', ResultadoAprendizajeController::class)->parameters([
        'modulos-formativos' => 'moduloFormativo',
        'resultados-aprendizaje' => 'resultadoAprendizaje'
    ]);

    // --------------------------------------------------
    // CRITERIOS EVALUACION
    Route::apiResource('resultados-aprendizaje.criterios-evaluacion', CriterioEvaluacionController::class)->parameters([
        'resultados-aprendizaje' => 'resultadoAprendizaje',
        'criterios-evaluacion' => 'criterioEvaluacion'
    ]);

    // --------------------------------------------------
    // ROLES
    Route::apiResource('roles', RolController::class)->parameters([
        'roles' => 'rol'
    ]);
});

Route::any('/{any}', function (ServerRequestInterface $request) {
    $config = new Config([
        'address' => env('DB_HOST', '127.0.0.1'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'basePath' => '/api',
    ]);
    $api = new Api($config);
    $response = $api->handle($request);

    try {
        $records = json_decode($response->getBody()->getContents())->records;
        $response = response()->json($records, 200, $headers = ['X-Total-Count' => count($records)]);
    } catch (\Throwable $th) {
    }
    return $response;
})->where('any', '.*');
