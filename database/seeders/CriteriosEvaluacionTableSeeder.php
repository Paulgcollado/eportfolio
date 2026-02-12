<?php

namespace Database\Seeders;

use App\Models\CriterioEvaluacion;
use Illuminate\Database\Seeder;

class CriteriosEvaluacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::seedCriteriosEvaluacion();
        $this->command->info('Tabla CRITERIOS EVALUACIÓN inicializada con datos!');
    }

    private function seedCriteriosEvaluacion()
    {
        CriterioEvaluacion::truncate();
        foreach (self::$criterios_evaluacion as $criterioEvaluacion) {
            $p = new CriterioEvaluacion();
            $p->resultado_aprendizaje_id = $criterioEvaluacion['resultado_aprendizaje_id'];
            $p->codigo = $criterioEvaluacion['codigo'];
            $p->descripcion = $criterioEvaluacion['descripcion'];
            $p->peso_porcentaje = $criterioEvaluacion['peso_porcentaje'];
            $p->orden = $criterioEvaluacion['orden'];
            $p->save();
        }
    }
    private static $criterios_evaluacion = [

    [
        'resultado_aprendizaje_id' => 1,
        'codigo' => 'a',
        'descripcion' => 'Se han caracterizado y diferenciado los modelos de ejecución de código en el servidor y en el cliente web.',
        'peso_porcentaje' => 50.00,
        'orden' => 1,
    ],
    [
        'resultado_aprendizaje_id' => 1,
        'codigo' => 'b',
        'descripcion' => 'Se han reconocido las ventajas que proporciona la generación dinámica de páginas.',
        'peso_porcentaje' => 50.00,
        'orden' => 2,
    ],
    [
        'resultado_aprendizaje_id' => 1,
        'codigo' => 'c',
        'descripcion' => 'Se han identificado los mecanismos de ejecución de código en los servidores web.',
        'peso_porcentaje' => 50.00,
        'orden' => 3,
    ],
    [
        'resultado_aprendizaje_id' => 1,
        'codigo' => 'd',
        'descripcion' => 'Se han reconocido las funcionalidades que aportan los servidores de aplicaciones y su integración con los servidores web.',
        'peso_porcentaje' => 50.00,
        'orden' => 4,
    ],
    [
        'resultado_aprendizaje_id' => 1,
        'codigo' => 'e',
        'descripcion' => 'Se han identificado y caracterizado los principales lenguajes y tecnologías relacionados con la programación web en entorno servidor.',
        'peso_porcentaje' => 50.00,
        'orden' => 5,
    ],
    [
        'resultado_aprendizaje_id' => 1,
        'codigo' => 'f',
        'descripcion' => 'Se han verificado los mecanismos de integración de los lenguajes de marcas con los lenguajes de programación en entorno servidor.',
        'peso_porcentaje' => 50.00,
        'orden' => 6,
    ],
    [
        'resultado_aprendizaje_id' => 1,
        'codigo' => 'g',
        'descripcion' => 'Se han reconocido y evaluado las herramientas y frameworks de programación en entorno servidor.',
        'peso_porcentaje' => 50.00,
        'orden' => 7,
    ],

    // Criterios del Resultado de Aprendizaje 2
    [
        'resultado_aprendizaje_id' => 2,
        'codigo' => 'a',
        'descripcion' => 'Se han reconocido los mecanismos de generación de páginas web a partir de lenguajes de marcas con código embebido.',
        'peso_porcentaje' => 50.00,
        'orden' => 8,
    ],
    [
        'resultado_aprendizaje_id' => 2,
        'codigo' => 'b',
        'descripcion' => 'Se han identificado las principales tecnologías asociadas.',
        'peso_porcentaje' => 50.00,
        'orden' => 9,
    ],
    [
        'resultado_aprendizaje_id' => 2,
        'codigo' => 'c',
        'descripcion' => 'Se han utilizado etiquetas para la inclusión de código en el lenguaje de marcas.',
        'peso_porcentaje' => 50.00,
        'orden' => 10,
    ],
    [
        'resultado_aprendizaje_id' => 2,
        'codigo' => 'd',
        'descripcion' => 'Se ha reconocido la sintaxis del lenguaje de programación que se ha de utilizar.',
        'peso_porcentaje' => 50.00,
        'orden' => 11,
    ],
    [
        'resultado_aprendizaje_id' => 2,
        'codigo' => 'e',
        'descripcion' => 'Se han escrito sentencias simples y se han comprobado sus efectos en el documento resultante.',
        'peso_porcentaje' => 50.00,
        'orden' => 12,
    ],
    [
        'resultado_aprendizaje_id' => 2,
        'codigo' => 'f',
        'descripcion' => 'Se han utilizado directivas para modificar el comportamiento predeterminado.',
        'peso_porcentaje' => 50.00,
        'orden' => 13,
    ],
    [
        'resultado_aprendizaje_id' => 2,
        'codigo' => 'g',
        'descripcion' => 'Se han utilizado los distintos tipos de variables y operadores disponibles en el lenguaje.',
        'peso_porcentaje' => 50.00,
        'orden' => 14,
    ],
    [
        'resultado_aprendizaje_id' => 2,
        'codigo' => 'h',
        'descripcion' => 'Se han identificado los ámbitos de utilización de las variables.',
        'peso_porcentaje' => 50.00,
        'orden' => 15,
    ],

    // Criterios del Resultado de Aprendizaje 3
    [
        'resultado_aprendizaje_id' => 3,
        'codigo' => 'a',
        'descripcion' => 'Se han utilizado mecanismos de decisión en la creación de bloques de sentencias.',
        'peso_porcentaje' => 50.00,
        'orden' => 16,
    ],
    [
        'resultado_aprendizaje_id' => 3,
        'codigo' => 'b',
        'descripcion' => 'Se han utilizado bucles y se ha verificado su funcionamiento.',
        'peso_porcentaje' => 50.00,
        'orden' => 17,
    ],
    [
        'resultado_aprendizaje_id' => 3,
        'codigo' => 'c',
        'descripcion' => 'Se han utilizado matrices (arrays) para almacenar y recuperar conjuntos de datos.',
        'peso_porcentaje' => 50.00,
        'orden' => 18,
    ],
    [
        'resultado_aprendizaje_id' => 3,
        'codigo' => 'd',
        'descripcion' => 'Se han creado y utilizado funciones.',
        'peso_porcentaje' => 50.00,
        'orden' => 19,
    ],
    [
        'resultado_aprendizaje_id' => 3,
        'codigo' => 'e',
        'descripcion' => 'Se han utilizado formularios web para interactuar con el usuario del navegador web.',
        'peso_porcentaje' => 50.00,
        'orden' => 20,
    ],
    [
        'resultado_aprendizaje_id' => 3,
        'codigo' => 'f',
        'descripcion' => 'Se han empleado métodos para recuperar la información introducida en el formulario.',
        'peso_porcentaje' => 50.00,
        'orden' => 21,
    ],
    [
        'resultado_aprendizaje_id' => 3,
        'codigo' => 'g',
        'descripcion' => 'Se han añadido comentarios al código.',
        'peso_porcentaje' => 50.00,
        'orden' => 22,
    ],
];
}
