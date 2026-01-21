<?php

use App\Http\Controllers\API\EvidenciaController;
use Psr\Http\Message\ServerRequestInterface;
use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EvaluacionEvidenciaController;
use App\Http\Controllers\API\TareasController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    // --------------------------------------------------
    // TAREAS
    Route::apiResource('tareas', TareasController::class)->only('store', 'update', 'destroy');
    Route::apiResource('criterios-evaluacion.tareas', TareasController::class)
        ->only('index', 'show')
        ->parameters(['criterios-evaluacion' => 'criterios']);
    Route::apiResource('resultados-aprendizaje.tareas', TareasController::class)
        ->only('index')
        ->parameters(['resultados-aprendizaje' => 'resultados']);

    // --------------------------------------------------
    // EVIDENCIAS
    Route::apiResource('tareas.evidencias', EvidenciaController::class);
    Route::get('users/{parent_id}/evidencias', [EvidenciaController::class, 'showUserEvidencias']);

    // --------------------------------------------------
    // EVALUACION EVIDENCIAS
    Route::apiResource('evidencias.evaluaciones-evidencias', EvaluacionEvidenciaController::class)->parameters([
        'evaluaciones-evidencias' => 'evaluacionEvidencia'
    ]);
});

/*
|--------------------------------------------------------------------------
| FALLBACK PHP-CRUD-API
|--------------------------------------------------------------------------
*/
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
